@extends('admin.admin_layout')
@section('title', 'Chi tiết đơn hàng')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Đơn hàng #{{ $row->id }}</h2>
    <a href="/admin/donhang" class="btn btn-outline-secondary">Quay lại</a>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="border p-3 bg-white">
            <div class="fw-bold mb-2">Thông tin khách hàng</div>
            <div>Họ tên: <span class="fw-bold">{{ $row->hoTen }}</span></div>
            <div>Email: <span class="fw-bold">{{ $row->email }}</span></div>
            <div>SĐT: <span class="fw-bold">{{ $row->sdt }}</span></div>
            <div>Địa chỉ: <span class="fw-bold">{{ $row->diaChi }}</span></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="border p-3 bg-white">
            <div class="fw-bold mb-2">Trạng thái đơn hàng</div>
            <form action="/admin/donhang/{{ $row->id }}" method="POST" class="d-flex gap-2">
                @csrf
                <select name="trangThai" class="form-select">
                    @foreach(['moi' => 'Mới', 'dang_xu_ly' => 'Đang xử lý', 'dang_giao' => 'Đang giao', 'hoan_tat' => 'Hoàn tất', 'huy' => 'Hủy'] as $k => $v)
                        <option value="{{ $k }}" @selected($row->trangThai === $k)>{{ $v }}</option>
                    @endforeach
                </select>
                <button class="btn btn-primary px-4">Cập nhật</button>
            </form>
            <div class="mt-3">Tổng tiền: <span class="fw-bold text-primary">{{ number_format($row->tongTien, 0, ',', '.') }}</span></div>
            <div>Ngày tạo: <span class="fw-bold">{{ $row->created_at }}</span></div>
        </div>
    </div>
</div>

<div class="fw-bold mb-2">Sản phẩm trong đơn</div>
<table class="table table-bordered align-middle">
    <thead>
        <tr>
            <th>Sản phẩm</th>
            <th class="text-end">Giá</th>
            <th class="text-center">Số lượng</th>
            <th class="text-end">Thành tiền</th>
        </tr>
    </thead>
    <tbody>
        @foreach($items as $it)
            <tr>
                <td>{{ $it->tenSP }}</td>
                <td class="text-end">{{ number_format($it->gia, 0, ',', '.') }}</td>
                <td class="text-center">{{ $it->soLuong }}</td>
                <td class="text-end fw-bold">{{ number_format($it->thanhTien, 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
