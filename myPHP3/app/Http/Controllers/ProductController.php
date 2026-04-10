<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index()
    {
        $dienthoai = DB::table('dienthoai')->orderBy('id', 'desc')->paginate(12);
        $tenLoai = 'Sản phẩm điện thoại';
        return view('dienthoai', compact('dienthoai', 'tenLoai'));
    }

    public function home()
    {
        $spMoi = DB::table('dienthoai')->orderBy('id', 'desc')->limit(8)->get();
        $spGiamGia = DB::table('dienthoai')->where('gia', '<', 5000000)->limit(4)->get();
        $loaiSP = DB::table('loaisp')->orderBy('thuTu', 'asc')->get();

        $loaiIds = $loaiSP->take(2)->pluck('id')->all();
        $productsByLoai = collect();
        if (!empty($loaiIds)) {
            $products = DB::table('dienthoai')
                ->whereIn('idLoai', $loaiIds)
                ->orderBy('id', 'desc')
                ->limit(24)
                ->get();
            $productsByLoai = $products->groupBy('idLoai');
        }

        return view('home', compact('spMoi', 'spGiamGia', 'loaiSP', 'productsByLoai'));
    }

    public function byLoai($id)
    {
        $tenLoai = DB::table('loaisp')->where('id', $id)->value('tenLoai');
        if (!$tenLoai) {
            return redirect('/dien-thoai');
        }
        $dienthoai = DB::table('dienthoai')->where('idLoai', $id)->orderBy('id', 'desc')->paginate(12);
        return view('dienthoai', compact('dienthoai', 'tenLoai'));
    }

    public function show($id)
    {
        $sp = DB::table('dienthoai')->where('id', $id)->first();
        if (!$sp) {
            return redirect('/dien-thoai');
        }

        $loai = null;
        if (isset($sp->idLoai)) {
            $loai = DB::table('loaisp')->where('id', $sp->idLoai)->first();
        }

        return view('chitietsp', ['sp' => $sp, 'loai' => $loai]);
    }

    public function gioHang()
    {
        $cart = Session::get('cart', []);
        return view('giohang', ['cart' => $cart]);
    }

    public function themGioHang(Request $request, $id)
    {
        $sp = DB::table('dienthoai')->where('id', $id)->first();
        if (!$sp) {
            return redirect('/dien-thoai');
        }

        $qty = (int) ($request->input('qty', 1));
        if ($qty < 1) $qty = 1;

        $cart = Session::get('cart', []);
        $key = (string) $sp->id;

        if (isset($cart[$key])) {
            $cart[$key]['qty'] += $qty;
        } else {
            $cart[$key] = [
                'id' => $sp->id,
                'tenDT' => $sp->tenDT,
                'gia' => (float) $sp->gia,
                'giaKM' => isset($sp->giaKM) ? (float) $sp->giaKM : null,
                'urlHinh' => $sp->urlHinh,
                'qty' => $qty,
            ];
        }

        Session::put('cart', $cart);
        return redirect('/gio-hang')->with('success', 'Đã thêm sản phẩm vào giỏ hàng.');
    }

    public function capNhatGioHang(Request $request)
    {
        $cart = Session::get('cart', []);
        $qtys = $request->input('qty', []);
        if (!is_array($qtys)) $qtys = [];

        foreach ($qtys as $id => $qty) {
            $key = (string) $id;
            if (!isset($cart[$key])) continue;
            $n = (int) $qty;
            if ($n <= 0) {
                unset($cart[$key]);
            } else {
                $cart[$key]['qty'] = $n;
            }
        }

        Session::put('cart', $cart);
        return redirect('/gio-hang')->with('success', 'Đã cập nhật giỏ hàng.');
    }

    public function xoaGioHang($id)
    {
        $cart = Session::get('cart', []);
        $key = (string) $id;
        if (isset($cart[$key])) {
            unset($cart[$key]);
            Session::put('cart', $cart);
        }
        return redirect('/gio-hang');
    }

    public function xoaHetGioHang()
    {
        Session::forget('cart');
        return redirect('/gio-hang')->with('success', 'Đã xóa toàn bộ giỏ hàng.');
    }

    public function datHang()
    {
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect('/gio-hang')->with('success', 'Giỏ hàng đang trống.');
        }
        if (!Auth::check()) return redirect('/dang-nhap');
        $u = Auth::user();

        return view('dathang', ['cart' => $cart, 'u' => $u]);
    }

    public function datHang_(Request $request)
    {
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect('/gio-hang')->with('success', 'Giỏ hàng đang trống.');
        }
        if (!Auth::check()) return redirect('/dang-nhap');

        $request->validate([
            'hoTen' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'sdt' => 'nullable|string|max:20',
            'diaChi' => 'nullable|string|max:255',
        ]);

        $userId = Auth::id();
        $tongTien = 0;
        foreach ($cart as $item) {
            $price = isset($item['giaKM']) && $item['giaKM'] ? $item['giaKM'] : $item['gia'];
            $tongTien += ((int) ($item['qty'] ?? 0)) * ((float) $price);
        }

        $idDH = DB::table('donhang')->insertGetId([
            'idUser' => $userId,
            'hoTen' => $request->hoTen,
            'email' => $request->email,
            'sdt' => $request->sdt,
            'diaChi' => $request->diaChi,
            'tongTien' => (int) round($tongTien),
            'trangThai' => 'moi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        foreach ($cart as $item) {
            $price = isset($item['giaKM']) && $item['giaKM'] ? $item['giaKM'] : $item['gia'];
            $qty = (int) ($item['qty'] ?? 0);
            if ($qty <= 0) continue;
            $sub = $qty * ((float) $price);

            DB::table('donhangchitiet')->insert([
                'idDH' => $idDH,
                'idSP' => (int) $item['id'],
                'tenSP' => $item['tenDT'],
                'gia' => (int) round((float) $price),
                'soLuong' => $qty,
                'thanhTien' => (int) round($sub),
                'urlHinh' => $item['urlHinh'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        Session::forget('cart');
        return redirect('/don-hang')->with('success', 'Đặt hàng thành công!');
    }

    public function loaiSP()
    {
        $loaisp = DB::table('loaisp')->get();
        return view('loaisanpham', compact('loaisp'));
    }

    public function thanhvien()
    {
        $thanhvien = DB::table('thanhvien')->get();
        return view('thanhvien', compact('thanhvien'));
    }
}
