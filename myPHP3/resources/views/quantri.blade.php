@extends('layout')

@section('tieudetrang')
Quản trị
@endsection

@section('noidung')
<div class="container">
    <h1>Trang quản trị</h1>
    <p>Chào admin: {{ Auth::user()->name }}</p>
</div>
@endsection
