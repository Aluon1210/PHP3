<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'dienthoai';
    protected $fillable = ['tenDT', 'gia', 'giaKM', 'urlHinh', 'moTa', 'idLoai', 'hot', 'AnHien'];
}
