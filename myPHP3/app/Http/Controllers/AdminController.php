<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function __construct()
    {
        // Simple admin check
        $this->middleware(function ($request, $next) {
            if (!Session::has('user') || DB::table('thanhvien')->where('id', Session::get('user.id'))->value('isGroup') != 1) {
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