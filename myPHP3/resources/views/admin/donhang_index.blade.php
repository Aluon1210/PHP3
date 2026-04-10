@extends('admin.admin_layout')
@section('title', 'Quản lý Đơn hàng')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Danh sách Đơn hàng</h2>
</div>

<table class="table table-bordered align-middle">
    <thead>
        <tr>
            <th>Mã</th>
            <th>Khách hàng</th>
            <th>Email</th>
            <th class="text-end">Tổng tiền</th>
            <th class="text-center">Trạng thái</th>
            <th>Ngày</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $row)
            <tr>
                <td class="fw-bold">#{{ $row->id }}</td>
                <td>{{ $row->hoTen }}{{ $row->name ? ' ('.$row->name.')' : '' }}</td>
                <td>{{ $row->email }}</td>
                <td class="text-end fw-bold text-primary">{{ number_format($row->tongTien, 0, ',', '.') }}</td>
                <td class="text-center"><span class="badge bg-secondary">{{ $row->trangThai }}</span></td>
                <td>{{ $row->created_at }}</td>
                <td>
                    <a href="/admin/donhang/{{ $row->id }}" class="btn btn-sm btn-outline-primary">Xem</a>
                    <a href="/admin/donhang-delete/{{ $row->id }}" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><i class="bi bi-trash"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center mt-4">
    {{ $data->links() }}
</div>
@endsection
