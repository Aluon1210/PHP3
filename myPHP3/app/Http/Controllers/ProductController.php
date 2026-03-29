<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $dienthoai = DB::table('dienthoai')->orderBy('id', 'desc')->paginate(12);
        return view('dienthoai', compact('dienthoai'));
    }

    public function home()
    {
        $spMoi = DB::table('dienthoai')->orderBy('id', 'desc')->limit(8)->get();
        $spGiamGia = DB::table('dienthoai')->where('gia', '<', 5000000)->limit(4)->get();
        $loaiSP = DB::table('LoaiSP')->get();
        return view('home', compact('spMoi', 'spGiamGia', 'loaiSP'));
    }

    public function loaisp()
    {
        $loaisp = DB::table('LoaiSP')->get();
        return view('loaisanpham', compact('loaisp'));
    }

    public function thanhvien()
    {
        $thanhvien = DB::table('thanhvien')->get();
        return view('thanhvien', compact('thanhvien'));
    }
}
