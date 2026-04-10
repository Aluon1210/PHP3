@extends('layout')

@section('tieudetrang')
Chi tiết đơn hàng #{{ $order->id ?? '' }}
@endsection

@section('noidung')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 fw-bold m-0">Đơn hàng #{{ $order->id }}</h1>
        <a href="/don-hang" class="btn btn-outline-secondary btn-sm">Quay lại</a>
    </div>

    <div class="border bg-white p-4 mb-3">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="text-muted small">Người nhận</div>
                <div class="fw-bold">{{ $order->hoTen }}</div>
                <div class="text-muted">{{ $order->email }}</div>
            </div>
            <div class="col-md-4">
                <div class="text-muted small">Liên hệ</div>
                <div class="fw-bold">{{ $order->sdt }}</div>
                <div class="text-muted">{{ $order->diaChi }}</div>
            </div>
            <div class="col-md-4 text-md-end">
                <div class="text-muted small">Trạng thái</div>
                <div class="fw-bold">{{ $order->trangThai }}</div>
                <div class="text-muted">{{ $order->created_at }}</div>
            </div>
        </div>
    </div>

    @php
        $total = 0;
    @endphp

    <div class="table-responsive border bg-white">
        <table class="table mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th>Sản phẩm</th>
                    <th style="width: 140px;" class="text-center">Số lượng</th>
                    <th style="width: 160px;" class="text-end">Đơn giá</th>
                    <th style="width: 160px;" class="text-end">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $it)
                    @php $total += $it->thanhTien; @endphp
                    <tr>
                        <td class="fw-bold">{{ $it->tenSP }}</td>
                        <td class="text-center">{{ $it->soLuong }}</td>
                        <td class="text-end">{{ number_format($it->gia, 0, ',', '.') }} VNĐ</td>
                        <td class="text-end fw-bold">{{ number_format($it->thanhTien, 0, ',', '.') }} VNĐ</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot class="table-light">
                <tr>
                    <td colspan="3" class="text-end fw-bold">Tổng cộng</td>
                    <td class="text-end fw-bold text-primary">{{ number_format($total, 0, ',', '.') }} VNĐ</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
