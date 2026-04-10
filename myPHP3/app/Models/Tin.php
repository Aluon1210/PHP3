<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Tin extends Model
{
    protected $table = 'tin';
    protected $primaryKey = 'id';
    public  $datas = ['ngagDang'];
    
    protected $fillable = [
        'tieuDe',
        'tomTat',
        'urlHinh',
        'ngayDang',
        'idLT',
        'xem',
        'noiBat',
        'anhien',
        'tag',
        'lang',
    ];
}