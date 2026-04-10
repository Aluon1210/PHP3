<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tin', function (Blueprint $table) {
            $table->id();
            $table->string('tieuDe', 500);
            $table->text('tomTat')->nullable();
            $table->longText('urlHinh')->nullable();
            $table->dateTime('ngayDang')->nullable();
            $table->unsignedBigInteger('idLT')->nullable();
            $table->integer('xem')->default(0);
            $table->tinyInteger('noiBat')->default(0);
            $table->tinyInteger('anhien')->default(1);
            $table->string('tag', 255)->nullable();
            $table->string('lang', 10)->default('vi');
            $table->longText('noiDung')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tin');
    }
};
