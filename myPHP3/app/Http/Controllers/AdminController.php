<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || (string) (Auth::user()->role ?? 'user') !== 'admin') {
                return redirect('/dang-nhap')->withErrors(['email' => 'Bạn không có quyền truy cập trang quản trị.']);
            }
            return $next($request);
        });
    }

    // Quản lý Loại tin
    public function loaitin_index()
    {
        $data = DB::table('loaitin')->orderBy('thuTu', 'asc')->get();
        return view('admin.loaitin_index', compact('data'));
    }

    public function loaitin_create()
    {
        return view('admin.loaitin_create');
    }

    public function loaitin_store(Request $request)
    {
        $request->validate(['ten' => 'required', 'thuTu' => 'required|integer']);
        DB::table('loaitin')->insert([
            'ten' => $request->ten,
            'thuTu' => $request->thuTu,
            'AnHien' => $request->AnHien ?? 1,
            'lang' => $request->lang ?? 'vi'
        ]);
        return redirect('/admin/loaitin')->with('success', 'Thêm loại tin thành công.');
    }

    public function loaitin_edit($id)
    {
        $row = DB::table('loaitin')->where('id', $id)->first();
        return view('admin.loaitin_edit', compact('row'));
    }

    public function loaitin_update(Request $request, $id)
    {
        $request->validate(['ten' => 'required', 'thuTu' => 'required|integer']);
        DB::table('loaitin')->where('id', $id)->update([
            'ten' => $request->ten,
            'thuTu' => $request->thuTu,
            'AnHien' => $request->AnHien ?? 1,
        ]);
        return redirect('/admin/loaitin')->with('success', 'Cập nhật loại tin thành công.');
    }

    public function loaitin_delete($id)
    {
        DB::table('loaitin')->where('id', $id)->delete();
        return back()->with('success', 'Đã xóa loại tin.');
    }

    public function loaisp_index()
    {
        $data = DB::table('loaisp')->orderBy('thuTu', 'asc')->paginate(15);
        return view('admin.loaisp_index', compact('data'));
    }

    public function loaisp_create()
    {
        return view('admin.loaisp_create');
    }

    public function loaisp_store(Request $request)
    {
        $request->validate([
            'tenLoai' => 'required',
            'thuTu' => 'required|integer',
        ]);

        DB::table('loaisp')->insert([
            'tenLoai' => $request->tenLoai,
            'thuTu' => $request->thuTu,
            'anHien' => $request->anHien ?? 1,
            'urlHinh' => $request->urlHinh,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/admin/loaisp')->with('success', 'Thêm loại sản phẩm thành công.');
    }

    public function loaisp_edit($id)
    {
        $row = DB::table('loaisp')->where('id', $id)->first();
        if (!$row) return redirect('/admin/loaisp');
        return view('admin.loaisp_edit', compact('row'));
    }

    public function loaisp_update(Request $request, $id)
    {
        $request->validate([
            'tenLoai' => 'required',
            'thuTu' => 'required|integer',
        ]);

        DB::table('loaisp')->where('id', $id)->update([
            'tenLoai' => $request->tenLoai,
            'thuTu' => $request->thuTu,
            'anHien' => $request->anHien ?? 1,
            'urlHinh' => $request->urlHinh,
            'updated_at' => now(),
        ]);

        return redirect('/admin/loaisp')->with('success', 'Cập nhật loại sản phẩm thành công.');
    }

    public function loaisp_delete($id)
    {
        DB::table('loaisp')->where('id', $id)->delete();
        return back()->with('success', 'Đã xóa loại sản phẩm.');
    }

    public function sanpham_index()
    {
        $spSearch = trim((string) request('sp_search', ''));

        $query = DB::table('dienthoai')
            ->join('loaisp', 'dienthoai.idLoai', '=', 'loaisp.id')
            ->select('dienthoai.*', 'loaisp.tenLoai')
            ->orderBy('dienthoai.id', 'desc');

        if ($spSearch !== '') {
            $query->where(function ($q) use ($spSearch) {
                $q->where('dienthoai.tenDT', 'like', "%{$spSearch}%")
                    ->orWhere('loaisp.tenLoai', 'like', "%{$spSearch}%")
                    ->orWhere('dienthoai.moTa', 'like', "%{$spSearch}%");
            });
        }

        $data = $query->paginate(15)->withQueryString();

        return view('admin.sanpham_index', compact('data'));
    }

    public function sanpham_create()
    {
        $loaisp = DB::table('loaisp')->orderBy('thuTu', 'asc')->get();
        return view('admin.sanpham_create', compact('loaisp'));
    }

    public function sanpham_store(Request $request)
    {
        $request->validate([
            'tenDT' => 'required|unique:dienthoai,tenDT',
            'gia' => 'required|numeric',
            'giaKM' => 'nullable|numeric',
            'idLoai' => 'required|integer',
            'soLuongTonKho' => 'required|integer|min:0',
        ]);

        DB::table('dienthoai')->insert([
            'tenDT' => $request->tenDT,
            'moTa' => $request->moTa,
            'ngayCapNhat' => now(),
            'gia' => $request->gia,
            'giaKM' => $request->giaKM,
            'urlHinh' => $request->urlHinh,
            'soLuongTonKho' => $request->soLuongTonKho,
            'hot' => $request->hot ?? 0,
            'TrangThai' => $request->TrangThai ?? 1,
            'baiViet' => $request->baiViet,
            'ghiChu' => $request->ghiChu,
            'idLoai' => $request->idLoai,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/admin/sanpham')->with('success', 'Thêm sản phẩm thành công.');
    }

    public function sanpham_edit($id)
    {
        $row = DB::table('dienthoai')->where('id', $id)->first();
        if (!$row) return redirect('/admin/sanpham');
        $loaisp = DB::table('loaisp')->orderBy('thuTu', 'asc')->get();
        return view('admin.sanpham_edit', compact('row', 'loaisp'));
    }

    public function sanpham_update(Request $request, $id)
    {
        $request->validate([
            'tenDT' => 'required',
            'gia' => 'required|numeric',
            'giaKM' => 'nullable|numeric',
            'idLoai' => 'required|integer',
            'soLuongTonKho' => 'required|integer|min:0',
        ]);

        DB::table('dienthoai')->where('id', $id)->update([
            'tenDT' => $request->tenDT,
            'moTa' => $request->moTa,
            'ngayCapNhat' => now(),
            'gia' => $request->gia,
            'giaKM' => $request->giaKM,
            'urlHinh' => $request->urlHinh,
            'soLuongTonKho' => $request->soLuongTonKho,
            'hot' => $request->hot ?? 0,
            'TrangThai' => $request->TrangThai ?? 1,
            'baiViet' => $request->baiViet,
            'ghiChu' => $request->ghiChu,
            'idLoai' => $request->idLoai,
            'updated_at' => now(),
        ]);

        return redirect('/admin/sanpham')->with('success', 'Cập nhật sản phẩm thành công.');
    }

    public function sanpham_delete($id)
    {
        DB::table('dienthoai')->where('id', $id)->delete();
        return back()->with('success', 'Đã xóa sản phẩm.');
    }

    public function donhang_index()
    {
        $data = DB::table('donhang')
            ->leftJoin('users', 'donhang.idUser', '=', 'users.id')
            ->select('donhang.*', 'users.name')
            ->orderBy('donhang.id', 'desc')
            ->paginate(15);

        return view('admin.donhang_index', compact('data'));
    }

    public function donhang_show($id)
    {
        $row = DB::table('donhang')->where('id', $id)->first();
        if (!$row) return redirect('/admin/donhang');
        $items = DB::table('donhangchitiet')->where('idDH', $row->id)->get();
        return view('admin.donhang_show', compact('row', 'items'));
    }

    public function donhang_update(Request $request, $id)
    {
        $request->validate(['trangThai' => 'required|string|max:30']);
        DB::table('donhang')->where('id', $id)->update([
            'trangThai' => $request->trangThai,
            'updated_at' => now(),
        ]);
        return redirect('/admin/donhang/' . $id)->with('success', 'Đã cập nhật trạng thái đơn hàng.');
    }

    public function donhang_delete($id)
    {
        DB::table('donhangchitiet')->where('idDH', $id)->delete();
        DB::table('donhang')->where('id', $id)->delete();
        return redirect('/admin/donhang')->with('success', 'Đã xóa đơn hàng.');
    }

    public function binhluan_index()
    {
        $data = DB::table('binhluan')
            ->leftJoin('tin', 'binhluan.idTin', '=', 'tin.id')
            ->leftJoin('dienthoai', 'binhluan.idSP', '=', 'dienthoai.id')
            ->join('users', 'binhluan.idUser', '=', 'users.id')
            ->select('binhluan.*', 'tin.tieuDe', 'dienthoai.tenDT', 'users.name')
            ->orderBy('binhluan.id', 'desc')
            ->paginate(15);

        return view('admin.binhluan_index', compact('data'));
    }

    public function binhluan_active($id, $active)
    {
        DB::table('binhluan')->where('id', $id)->update([
            'active' => (int) $active ? 1 : 0,
            'updated_at' => now(),
        ]);
        return back()->with('success', 'Đã cập nhật trạng thái bình luận.');
    }

    public function binhluan_delete($id)
    {
        DB::table('binhluan')->where('id', $id)->delete();
        return back()->with('success', 'Đã xóa bình luận.');
    }

    // Quản lý Tin
    public function tin_index()
    {
        $data = DB::table('tin')
            ->join('loaitin', 'tin.idLT', '=', 'loaitin.id')
            ->select('tin.*', 'loaitin.ten as tenLoai')
            ->orderBy('tin.id', 'desc')
            ->paginate(15);
        return view('admin.tin_index', compact('data'));
    }

    public function tin_create()
    {
        $loaitin = DB::table('loaitin')->get();
        return view('admin.tin_create', compact('loaitin'));
    }

    public function tin_store(Request $request)
    {
        $request->validate(['tieuDe' => 'required', 'idLT' => 'required', 'noiDung' => 'required']);
        DB::table('tin')->insert([
            'tieuDe' => $request->tieuDe,
            'idLT' => $request->idLT,
            'tomTat' => $request->tomTat,
            'noiDung' => $request->noiDung,
            'ngayDang' => now(),
            'AnHien' => $request->AnHien ?? 1,
            'lang' => 'vi'
        ]);
        return redirect('/admin/tin')->with('success', 'Thêm tin thành công.');
    }

    public function tin_edit($id)
    {
        $row = DB::table('tin')->where('id', $id)->first();
        $loaitin = DB::table('loaitin')->get();
        return view('admin.tin_edit', compact('row', 'loaitin'));
    }

    public function tin_update(Request $request, $id)
    {
        $request->validate(['tieuDe' => 'required', 'idLT' => 'required', 'noiDung' => 'required']);
        DB::table('tin')->where('id', $id)->update([
            'tieuDe' => $request->tieuDe,
            'idLT' => $request->idLT,
            'tomTat' => $request->tomTat,
            'noiDung' => $request->noiDung,
            'AnHien' => $request->AnHien ?? 1,
        ]);
        return redirect('/admin/tin')->with('success', 'Cập nhật tin thành công.');
    }

    public function tin_delete($id)
    {
        DB::table('tin')->where('id', $id)->delete();
        return back()->with('success', 'Đã xóa tin.');
    }
}
