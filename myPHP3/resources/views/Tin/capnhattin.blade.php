@extends('layout')

@section('noidung')
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Cập Nhật Tin</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('tin.capnhat_', $tin->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Tiêu đề</label>
                    <input type="text" name="tieuDe" class="form-control" value="{{ $tin->tieuDe }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Tóm tắt</label>
                    <textarea name="tomTat" class="form-control" rows="3">{{ $tin->tomTat }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">URL Hình</label>
                    <input type="text" name="urlHinh" class="form-control" value="{{ $tin->urlHinh }}">
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Danh mục</label>
                    <select name="idLT" class="form-select">
                        @foreach($loaitin as $lt)
                            <option value="{{ $lt->id }}" @selected($lt->id == $tin->idLT)>{{ $lt->ten }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="/tin/ds" class="btn btn-outline-secondary px-4">Quay lại</a>
                    <button type="submit" class="btn btn-primary px-5 py-2">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
