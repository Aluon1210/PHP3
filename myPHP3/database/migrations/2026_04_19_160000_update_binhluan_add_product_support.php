<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('binhluan', function (Blueprint $table) {
            $table->unsignedBigInteger('idSP')->nullable()->after('idTin');
            $table->index('idSP');
        });

        DB::statement('ALTER TABLE binhluan MODIFY idTin BIGINT UNSIGNED NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE binhluan MODIFY idTin BIGINT UNSIGNED NOT NULL');

        Schema::table('binhluan', function (Blueprint $table) {
            $table->dropIndex(['idSP']);
            $table->dropColumn('idSP');
        });
    }
};
