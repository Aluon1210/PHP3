<?php

namespace Database\Seeders;
use DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
class chenthanhvien extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $ho = ['Nguyen', 'Tran', 'Le', 'Pham', 'Hoang', 'Vu', 'Dang', 'Bui', 'Do', 'Ngo'];
        $ten = ['An', 'Binh', 'Cuong', 'Duc', 'Giang', 'Hieu', 'Khoa', 'Linh', 'Minh', 'Phuc'];
        $lot = ['Van', 'Thi', 'Dinh', 'Quang', 'Hong', 'Thanh', 'Xuan', 'Phuong', 'Hoang', 'Dang'];
        for($i = 0; $i < 10; $i++) {
            $ht = Arr::random($ho).' '.Arr::random($lot).' '.Arr::random($ten);
            DB::table('thanhvien')->insert([
                'hoTen' => $ht , 
                'email' => Str::random(10).'@gmail.com',
                'password' => bcrypt('thanhcong'),
            ]);
                
        }         
    }
}