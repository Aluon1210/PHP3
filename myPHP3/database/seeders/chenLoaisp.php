<?php

namespace Database\Seeders;
use DB;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class chenLoaisp extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('loaisp')->insert([
            ['tenLoai' => 'SamSung', 'thuTu' => 1, 'anHien' => 1, 'urlHinh' => null],
            ['tenLoai' => 'HTC', 'thuTu' => 2, 'anHien' => 1, 'urlHinh' => null],
            ['tenLoai' => 'Apple', 'thuTu' => 3, 'anHien' => 1, 'urlHinh' => null],
            ['tenLoai' => 'LG', 'thuTu' => 4, 'anHien' => 1, 'urlHinh' => null],
            ['tenLoai' => 'Motorola', 'thuTu' => 4, 'anHien' => 1, 'urlHinh' => null],
            ['tenLoai' => 'Mobel', 'thuTu' => 4, 'anHien' => 1, 'urlHinh' => null],
        ]);
        
    }
}