<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donhang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idUser')->nullable();
            $table->string('hoTen', 100);
            $table->string('email', 100);
            $table->string('sdt', 20)->nullable();
            $table->string('diaChi', 255)->nullable();
            $table->decimal('tongTien', 12, 0)->default(0);
            $table->string('trangThai', 30)->default('moi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donhang');
    }
};
