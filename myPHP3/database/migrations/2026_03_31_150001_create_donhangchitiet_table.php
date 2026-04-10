<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donhangchitiet', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idDH');
            $table->unsignedBigInteger('idSP');
            $table->string('tenSP', 255);
            $table->decimal('gia', 12, 0)->default(0);
            $table->integer('soLuong')->default(1);
            $table->decimal('thanhTien', 12, 0)->default(0);
            $table->string('urlHinh', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donhangchitiet');
    }
};
