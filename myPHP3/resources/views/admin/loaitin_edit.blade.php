@extends('admin.admin_layout')
@section('title', 'Cập nhật Loại tin')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Cập nhật Loại tin</h2>
    <a href="/admin/loaitin" class="btn btn-outline-secondary">Quay lại</a>
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

<form action="/admin/loaitin/update/{{ $row->id }}" method="POST">
    @csrf
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label fw-bold">Tên loại tin</label>
            <input type="text" name="ten" class="form-control" value="{{ old('ten', $row->ten) }}">
        </div>
        <div class="col-md-3">
            <label class="form-label fw-bold">Thứ tự</label>
            <input type="number" name="thuTu" class="form-control" value="{{ old('thuTu', $row->thuTu) }}">
        </div>
        <div class="col-md-3">
            <label class="form-label fw-bold">Trạng thái</label>
            <select name="AnHien" class="form-select">
                <option value="1" @selected(old('AnHien', $row->AnHien) == 1)>Hiện</option>
                <option value="0" @selected(old('AnHien', $row->AnHien) == 0)>Ẩn</option>
            </select>
        </div>
        <div class="col-12 text-end mt-4">
            <button class="btn btn-primary px-5">Lưu</button>
        </div>
    </div>
</form>
@endsection
