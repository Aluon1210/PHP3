<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('thanhvien')->where('active', 0)->update(['active' => 1]);

        $exists = DB::table('thanhvien')->where('email', 'tv@example.com')->exists();
        if (!$exists) {
            DB::table('thanhvien')->insert([
                'hoTen' => 'Thanh Vien Demo',
                'email' => 'tv@gmail.com',
                'password' => Hash::make('thanhcong'),
                'randomKey' => null,
                'active' => 1,
                'isGroup' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        DB::table('thanhvien')->where('email', 'tv@gmail.com')->delete();
    }
};
