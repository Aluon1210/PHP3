<?php

namespace Database\Seeders;
USE DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class chendienthoai extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for($i = 1; $i <=300; $i++) {
            DB::Table('dienthoai')->insert([
                ['tenDT' => 'Oppo AX '.$i, 'moTa' => 'Mo ta dien thoai '.$i, 'ngayCapNhat' => now(), 'gia' => rand(700000, 1000000),'giaKM' => rand(500000, 9000000), 'urlHinh' => null, 'soLuongTonKho' => rand(0, 100), 'hot' => rand(0, 1), 'TrangThai' => rand(0, 1), 'baiViet' => null, 'ghiChu' => null, 'idLoai' =>2],
                ['tenDT' => 'Iphone sx max '.$i, 'moTa' => 'Mo ta dien thoai '.$i, 'ngayCapNhat' => now(), 'gia' => rand(500000, 800000),'giaKM' => rand(500000, 9000000), 'urlHinh' => null, 'soLuongTonKho' => rand(0, 100), 'hot' => rand(0, 1), 'TrangThai' => rand(0, 1), 'baiViet' => null, 'ghiChu' => null, 'idLoai' =>3],
                ['tenDT' => 'Nokia Pro'.$i, 'moTa' => 'Mo ta dien thoai '.$i, 'ngayCapNhat' => now(), 'gia' => rand(250000, 500000),'giaKM' => rand(500000, 9000000), 'urlHinh' => null, 'soLuongTonKho' => rand(0, 100), 'hot' => rand(0, 1), 'TrangThai' => rand(0, 1), 'baiViet' => null, 'ghiChu' => null, 'idLoai' =>1],
            ]);
        }
    }
} 