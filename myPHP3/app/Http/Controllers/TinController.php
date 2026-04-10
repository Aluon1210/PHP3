<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TinController extends Controller
{
    //

    public function lienhe()
    {
        return view('lienhe');
    }

    public function index()
    {
        $data = DB::table('tin')
            ->leftJoin('loaitin', 'tin.idLT', '=', 'loaitin.id')
            ->select('tin.*', 'loaitin.ten as tenLoai')
            ->orderBy('tin.ngayDang', 'desc')
            ->paginate(6);

        return view('Tin/danhsach', ['data' => $data]);
    }

    public function them()
    {
        $loaitin = DB::table('loaitin')->get();
        return view('Tin/themtin', ['loaitin' => $loaitin]);
    }

    public function them_(Request $request)
    {
        $t = new \App\Models\Tin;
        $t->tieuDe = $request->tieuDe;
        $t->tomTat = $request->tomTat;
        $t->urlHinh = $request->urlHinh;
        $t->idLT = $request->idLT;
        $t->save();
        return redirect('/tin/ds');
    }

    public function xoa($id)
    {
        $t = \App\Models\Tin::find($id);
        if ($t == null) return redirect('/tin/ds');
        $t->delete();
        return redirect('/tin/ds');
    }

    public function capnhat($id)
    {
        $t = \App\Models\Tin::find($id);
        if ($t == null) return redirect('/tin/ds');
        $loaitin = DB::table('loaitin')->get();
        return view('Tin/capnhattin', ['tin' => $t, 'loaitin' => $loaitin]);
    }

    public function capnhat_(Request $request, $id)
    {
        $t = \App\Models\Tin::find($id);
        if ($t == null) return redirect('/tin/ds');

        $t->tieuDe = $request->tieuDe;
        $t->tomTat = $request->tomTat;
        $t->urlHinh = $request->urlHinh;
        $t->idLT = $request->idLT;
        $t->save();

        return redirect('/tin/ds');
    }
    public function chitiet($id)
    {
        $tin = DB::table('tin')->where('id', $id)->first();
        if (!$tin) return redirect('/');

        $binhluan = DB::table('binhluan')
            ->join('users', 'binhluan.idUser', '=', 'users.id')
            ->where('idTin', $id)
            ->where('binhluan.active', 1)
            ->select('binhluan.*', 'users.name as hoTen')
            ->orderBy('ngayDang', 'desc')
            ->get();

        return view('chitiet', ['tin' => $tin, 'binhluan' => $binhluan]);
    }

    public function binhluan(Request $request)
    {
        if (!Auth::check()) {
            return back()->withErrors(['email' => 'Vui lòng đăng nhập để bình luận.']);
        }

        $request->validate([
            'idTin' => 'required',
            'noiDung' => 'required|string|max:500',
        ]);

        DB::table('binhluan')->insert([
            'idTin' => $request->idTin,
            'idUser' => Auth::id(),
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
        $listtin = DB::table('tin')
            ->where('idLT', $idLT)
            ->orderBy('ngayDang', 'desc')
            ->paginate(6);
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
            'tenloai' => 'Kết quả tìm kiếm cho: "' . $keyword . '"'
        ]);
    }
}
