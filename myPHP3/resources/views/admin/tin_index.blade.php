@extends('admin.admin_layout')
@section('title', 'Quản lý Tin')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Danh sách Tin tức</h2>
    <a href="/admin/tin/create" class="btn btn-primary">Thêm mới</a>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tiêu đề</th>
            <th>Loại tin</th>
            <th>Ngày đăng</th>
            <th>Xem</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $tin)
        <tr>
            <td>{{ $tin->id }}</td>
            <td>{{ Str::limit($tin->tieuDe, 60) }}</td>
            <td>{{ $tin->tenLoai }}</td>
            <td>{{ date('d/m/Y', strtotime($tin->ngayDang)) }}</td>
            <td>{{ $tin->xem }}</td>
            <td>
                <a href="/admin/tin/edit/{{ $tin->id }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                <a href="/admin/tin/delete/{{ $tin->id }}" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><i class="bi bi-trash"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center mt-4">
    {{ $data->links() }}
</div>
@endsection
