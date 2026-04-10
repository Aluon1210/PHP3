@extends('layout')

@section('noidung')
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Thêm Tin Mới</h3>
        </div>
        <div class="card-body">
            <form action="/tin/them" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Tiêu đề</label>
                    <input type="text" name="tieuDe" class="form-control" placeholder="Nhập tiêu đề tin">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Tóm tắt</label>
                    <textarea name="tomTat" class="form-control" rows="3" placeholder="Nhập tóm tắt tin"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">URL Hình</label>
                    <input type="text" name="urlHinh" class="form-control" placeholder="URL hình ảnh sản phẩm">
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Danh mục</label>
                    <select name="idLT" class="form-select">
                        @foreach($loaitin as $lt)
                            <option value="{{ $lt->id }}">{{ $lt->ten }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary px-5 py-2">Thêm tin ngay</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection