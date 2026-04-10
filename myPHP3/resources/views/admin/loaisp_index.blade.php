@extends('admin.admin_layout')
@section('title', 'Quản lý Loại sản phẩm')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Danh sách Loại sản phẩm</h2>
    <a href="/admin/loaisp/create" class="btn btn-primary">Thêm mới</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên loại</th>
            <th>Thứ tự</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->tenLoai }}</td>
                <td>{{ $row->thuTu }}</td>
                <td>{{ (int)$row->anHien === 1 ? 'Hiện' : 'Ẩn' }}</td>
                <td>
                    <a href="/admin/loaisp/edit/{{ $row->id }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                    <a href="/admin/loaisp/delete/{{ $row->id }}" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><i class="bi bi-trash"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center mt-4">
    {{ $data->links() }}
</div>
@endsection
