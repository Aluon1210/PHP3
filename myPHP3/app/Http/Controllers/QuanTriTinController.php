<?php

namespace App\Http\Controllers;

class QuanTriTinController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        echo '<h1>Quản trị tin</h1>';
    }
}
