<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiTinController extends Controller
{
    public function tin_theo_loai($idLT)
    {
        $data = DB::table('tin')
            ->where('idLT', $idLT)
            ->where('AnHien', 1)
            ->orderBy('id', 'desc')
            ->get();
        return response()->json($data, 200);
    }

    public function chi_tiet_tin($id)
    {
        $tin = DB::table('tin')->where('id', $id)->first();
        if ($tin) {
            return response()->json($tin, 200);
        }
        return response()->json(['message' => 'Không tìm thấy tin'], 404);
    }
}
