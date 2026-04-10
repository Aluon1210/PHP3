@extends('layout')

@section('tieudetrang')
Thông tin cá nhân
@endsection

@section('noidung')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 fw-bold m-0">Thông tin cá nhân</h1>
        <a href="/don-hang" class="btn btn-outline-primary btn-sm">Lịch sử đơn hàng</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success border-0 rounded-0">{{ session('success') }}</div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger border-0 rounded-0">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="border bg-white p-4">
        <form action="/thong-tin-ca-nhan" method="POST" class="row g-3">
            @csrf
            <div class="col-md-6">
                <label class="form-label fw-bold">Họ tên</label>
                <input type="text" name="hoTen" class="form-control" value="{{ $u->name ?? '' }}">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $u->email ?? '' }}">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Số điện thoại</label>
                <input type="text" name="phone" class="form-control" value="{{ $u->phone ?? '' }}">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Nghề Nghiệp</label>
                <input type="text" name="nghenghiep" class="form-control" value="{{ $u->nghenghiep ?? '' }}">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Phái</label>
                <select name="phai" class="form-select">
                    <option value="">-- Chọn phái --</option>
                    <option value="Nam" {{ (isset($u->phai) && $u->phai == 'Nam') ? 'selected' : '' }}>Nam</option>
                    <option value="Nữ" {{ (isset($u->phai) && $u->phai == 'Nữ') ? 'selected' : '' }}>Nữ</option>
                </select>
                < <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary px-5">Lưu</button>
            </div>
        </form>
    </div>
</div>
@endsection