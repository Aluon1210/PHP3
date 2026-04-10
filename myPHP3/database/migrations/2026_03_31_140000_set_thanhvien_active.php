<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('thanhvien')->update(['active' => 1]);
    }

    public function down(): void
    {
        // Không cần rollback dữ liệu trạng thái
    }
};
