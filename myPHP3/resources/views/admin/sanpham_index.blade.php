@extends('admin.admin_layout')
@section('title', 'Quản lý Sản phẩm')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Danh sách Sản phẩm</h2>
    <section>
        <form action="/admin/sanpham" method="GET" class="d-flex">
            <input type="text" name="sp_search" class="form-control" placeholder="Tìm kiếm sản phẩm..." value="{{ request('sp_search') }}">
            <button class="btn btn-outline-secondary ms-2" type="submit">Tìm kiếm</button>
        </form>
    </section>
    <a href="/admin/sanpham/create" class="btn btn-primary">Thêm mới</a>
</div>

<table class="table table-bordered align-middle">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Loại</th>
            <th class="text-end">Giá</th>
            <th class="text-end">Giá KM</th>
            <th class="text-center">Tồn kho</th>
            <th class="text-center">Hot</th>
            <th class="text-center">Trạng thái</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td style="max-width: 260px;">{{ $row->tenDT }}</td>
                <td>{{ $row->tenLoai }}</td>
                <td class="text-end">{{ number_format($row->gia, 0, ',', '.') }}</td>
                <td class="text-end">{{ $row->giaKM ? number_format($row->giaKM, 0, ',', '.') : '-' }}</td>
                <td class="text-center">{{ $row->soLuongTonKho }}</td>
                <td class="text-center">{{ (int)$row->hot === 1 ? 'Có' : 'Không' }}</td>
                <td class="text-center">{{ (int)$row->TrangThai === 1 ? 'Đang bán' : 'Ngưng' }}</td>
                <td>
                    <a href="/admin/sanpham/edit/{{ $row->id }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                    <a href="/admin/sanpham/delete/{{ $row->id }}" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><i class="bi bi-trash"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center mt-4">
    {{ $data->links() }}
</div>
@endsection
