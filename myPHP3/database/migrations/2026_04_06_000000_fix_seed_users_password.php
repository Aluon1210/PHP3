<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        $emails = ['vuiqua@gmail.com', 'giahuy@gmail.com', 'buonqua@gmail.com'];
        foreach ($emails as $email) {
            $u = DB::table('users')->where('email', $email)->first();
            if (!$u || !is_string($u->password)) {
                continue;
            }

            if (!Hash::check('thanhcong', $u->password)) {
                DB::table('users')->where('id', $u->id)->update([
                    'password' => Hash::make('thanhcong'),
                    'remember_token' => null,
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function down(): void
    {
    }
};
