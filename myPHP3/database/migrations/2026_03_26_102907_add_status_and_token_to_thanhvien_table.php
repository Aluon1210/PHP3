<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('thanhvien', function (Blueprint $table) {
            if (!Schema::hasColumn('thanhvien', 'activation_token')) {
                $table->string('activation_token')->nullable()->after('active');
            }
            if (!Schema::hasColumn('thanhvien', 'reset_token')) {
                $table->string('reset_token')->nullable()->after('activation_token');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('thanhvien', function (Blueprint $table) {
            $table->dropColumn(['activation_token', 'reset_token']);
        });
    }
};
