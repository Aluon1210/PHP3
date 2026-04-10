@extends('admin.admin_layout')
@section('title', 'Thêm Tin')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Thêm Tin</h2>
    <a href="/admin/tin" class="btn btn-outline-secondary">Quay lại</a>
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

<form action="/admin/tin/store" method="POST">
    @csrf
    <div class="row g-3">
        <div class="col-md-8">
            <label class="form-label fw-bold">Tiêu đề</label>
            <input type="text" name="tieuDe" class="form-control" value="{{ old('tieuDe') }}">
        </div>
        <div class="col-md-4">
            <label class="form-label fw-bold">Loại tin</label>
            <select name="idLT" class="form-select">
                @foreach($loaitin as $lt)
                    <option value="{{ $lt->id }}" @selected(old('idLT') == $lt->id)>{{ $lt->ten }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-12">
            <label class="form-label fw-bold">Tóm tắt</label>
            <textarea name="tomTat" class="form-control" rows="3">{{ old('tomTat') }}</textarea>
        </div>
        <div class="col-md-12">
            <label class="form-label fw-bold">Nội dung</label>
            <textarea name="noiDung" class="form-control" rows="8">{{ old('noiDung') }}</textarea>
        </div>
        <div class="col-md-4">
            <label class="form-label fw-bold">Trạng thái</label>
            <select name="AnHien" class="form-select">
                <option value="1" @selected(old('AnHien', 1) == 1)>Hiện</option>
                <option value="0" @selected(old('AnHien', 1) == 0)>Ẩn</option>
            </select>
        </div>
        <div class="col-12 text-end mt-4">
            <button class="btn btn-primary px-5">Lưu</button>
        </div>
    </div>
</form>
@endsection
