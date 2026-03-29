<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class TinController extends Controller
{
    //
    public function index()
    {
        return view('home');
    }

    public function lienhe()
    {
        return view('lienhe');
    }

    public function chitiet($id)
    {
        $tin = DB::table('tin')->where('id', $id)->first();
        if (!$tin) return redirect('/');
        
        $binhluan = DB::table('binhluan')
            ->join('thanhvien', 'binhluan.idUser', '=', 'thanhvien.id')
            ->where('idTin', $id)
            ->where('binhluan.active', 1)
            ->select('binhluan.*', 'thanhvien.hoTen')
            ->orderBy('ngayDang', 'desc')
            ->get();

        return view('chitiet', ['tin' => $tin, 'binhluan' => $binhluan]);
    }

    public function binhluan(Request $request)
    {
        if (!Session::has('user')) {
            return back()->withErrors(['email' => 'Vui lòng đăng nhập để bình luận.']);
        }

        $request->validate([
            'idTin' => 'required',
            'noiDung' => 'required|string|max:500',
        ]);

        DB::table('binhluan')->insert([
            'idTin' => $request->idTin,
            'idUser' => Session::get('user.id'),
            'noiDung' => $request->noiDung,
            'ngayDang' => now(),
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Bình luận của bạn đã được gửi.');
    }

    public function tintrongloai($idLT)
    {
        $listtin = DB::table('tin')->where('idLT', $idLT)->paginate(2);
        $tenloai = DB::table('loaitin')->where('id', $idLT)->value('ten');
        return view('tintrongloai', ['listtin' => $listtin, 'tenloai' => $tenloai]);
    }

    public function timkiem(Request $request)
    {
        $keyword = $request->input('keyword');
        
        // Tìm kiếm tin tức
        $listtin = DB::table('tin')
            ->where('tieuDe', 'like', "%{$keyword}%")
            ->orWhere('tomTat', 'like', "%{$keyword}%")
            ->get();

        // Tìm kiếm sản phẩm điện thoại
        $listsp = DB::table('dienthoai')
            ->where('tenDT', 'like', "%{$keyword}%")
            ->get();

        return view('timkiem', [
            'listtin' => $listtin, 
            'listsp' => $listsp,
            'keyword' => $keyword,
            'tenloai' => 'Kết quả tìm kiếm cho: "'.$keyword.'"'
        ]);
    }
}