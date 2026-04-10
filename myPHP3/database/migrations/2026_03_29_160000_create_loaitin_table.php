<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loaitin', function (Blueprint $table) {
            $table->id();
            $table->string('ten', 255);
            $table->integer('thuTu')->default(0);
            $table->tinyInteger('AnHien')->default(1);
            $table->string('lang', 10)->default('vi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loaitin');
    }
};
