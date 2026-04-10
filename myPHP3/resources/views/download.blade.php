@extends('layout')

@section('tieudetrang')
Download
@endsection

@section('noidung')
<h1>
    Chào bạn, đây là Trang download của tôi,
    dành cho thành viên đã đăng nhập.
</h1>

<p>CHÀO BẠN {{ Auth::user()->name }}</p>
@endsection
