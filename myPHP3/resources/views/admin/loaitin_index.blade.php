@extends('admin.admin_layout')
@section('title', 'Quản lý Loại tin')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Danh sách Loại tin</h2>
    <a href="/admin/loaitin/create" class="btn btn-primary">Thêm mới</a>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên Loại</th>
            <th>Thứ tự</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $lt)
        <tr>
            <td>{{ $lt->id }}</td>
            <td>{{ $lt->ten }}</td>
            <td>{{ $lt->thuTu }}</td>
            <td>{{ $lt->AnHien == 1 ? 'Hiện' : 'Ẩn' }}</td>
            <td>
                <a href="/admin/loaitin/edit/{{ $lt->id }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                <a href="/admin/loaitin/delete/{{ $lt->id }}" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><i class="bi bi-trash"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
