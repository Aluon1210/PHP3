@extends('admin.admin_layout')
@section('title', 'Thêm Sản phẩm')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Thêm Sản phẩm</h2>
    <a href="/admin/sanpham" class="btn btn-outline-secondary">Quay lại</a>
</div>

@if($errors->any())
    <div class="alert alert-danger border-0 rounded-0 shadow-sm">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="/admin/sanpham/store" method="POST">
    @csrf
    <div class="row g-3">
        <div class="col-md-8">
            <label class="form-label fw-bold">Tên sản phẩm</label>
            <input type="text" name="tenDT" class="form-control" value="{{ old('tenDT') }}">
        </div>
        <div class="col-md-4">
            <label class="form-label fw-bold">Loại sản phẩm</label>
            <select name="idLoai" class="form-select">
                @foreach($loaisp as $lt)
                    <option value="{{ $lt->id }}" @selected(old('idLoai') == $lt->id)>{{ $lt->tenLoai }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-bold">Giá</label>
            <input type="number" step="0.01" name="gia" class="form-control" value="{{ old('gia') }}">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-bold">Giá khuyến mãi</label>
            <input type="number" step="0.01" name="giaKM" class="form-control" value="{{ old('giaKM') }}">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-bold">Tồn kho</label>
            <input type="number" name="soLuongTonKho" class="form-control" value="{{ old('soLuongTonKho', 0) }}">
        </div>
        <div class="col-md-3">
            <label class="form-label fw-bold">Hot</label>
            <select name="hot" class="form-select">
                <option value="0" @selected(old('hot', 0) == 0)>Không</option>
                <option value="1" @selected(old('hot', 0) == 1)>Có</option>
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label fw-bold">Trạng thái</label>
            <select name="TrangThai" class="form-select">
                <option value="1" @selected(old('TrangThai', 1) == 1)>Đang bán</option>
                <option value="0" @selected(old('TrangThai', 1) == 0)>Ngưng</option>
            </select>
        </div>
        <div class="col-md-12">
            <label class="form-label fw-bold">Mô tả</label>
            <textarea name="moTa" class="form-control" rows="3">{{ old('moTa') }}</textarea>
        </div>
        <div class="col-md-12">
            <label class="form-label fw-bold">URL Hình</label>
            <input type="text" name="urlHinh" class="form-control" value="{{ old('urlHinh') }}">
        </div>
        <div class="col-md-12">
            <label class="form-label fw-bold">Bài viết</label>
            <textarea name="baiViet" class="form-control" rows="4">{{ old('baiViet') }}</textarea>
        </div>
        <div class="col-md-12">
            <label class="form-label fw-bold">Ghi chú</label>
            <textarea name="ghiChu" class="form-control" rows="2">{{ old('ghiChu') }}</textarea>
        </div>
        <div class="col-12 text-end mt-4">
            <button class="btn btn-primary px-5">Lưu</button>
        </div>
    </div>
</form>
@endsection
