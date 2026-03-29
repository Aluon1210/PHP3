<?php

namespace App\Http\Controllers ;
use App\Http\Controllers\Controller;

class PortfolioController  extends Controller
{
    //
    public function index()
    {
        $info = [
            'last_name' => "Dương",
            'first_name' => "Thành Công",
            'age' => '20',
            'job' => "Lập trình viên",
            "skills" => [
                'PHP',
                'JavaScript',
                'HTML',
                'CSS'
            ],
            "soft_skills" => [
                'Giao tiếp',
                'Làm việc nhóm',
                'Giải quyết vấn đề'
            ]
        ];
        return view('portfolio', compact('info'));
    }
}