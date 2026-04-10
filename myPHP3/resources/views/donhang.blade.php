@extends('layout')

@section('tieudetrang')
Lịch sử đơn hàng
@endsection

@section('noidung')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 fw-bold m-0">Lịch sử đơn hàng</h1>
        <a href="/thong-tin-ca-nhan" class="btn btn-outline-primary btn-sm">Thông tin cá nhân</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 rounded-0">{{ session('success') }}</div>
    @endif

    @if($orders->isEmpty())
        <div class="border bg-white p-5 text-center text-muted">
            <div class="display-6 mb-2"><i class="bi bi-receipt"></i></div>
            <div>Bạn chưa có đơn hàng nào.</div>
        </div>
    @else
        <div class="table-responsive border bg-white">
            <table class="table mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 90px;">Mã</th>
                        <th style="width: 180px;">Ngày</th>
                        <th style="width: 160px;" class="text-end">Tổng tiền</th>
                        <th style="width: 140px;" class="text-center">Trạng thái</th>
                        <th style="width: 140px;" class="text-end">Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $o)
                        <tr>
                            <td class="fw-bold">#{{ $o->id }}</td>
                            <td>{{ $o->created_at }}</td>
                            <td class="text-end fw-bold text-primary">{{ number_format($o->tongTien, 0, ',', '.') }} VNĐ</td>
                            <td class="text-center">
                                <span class="badge bg-secondary">{{ $o->trangThai }}</span>
                            </td>
                            <td class="text-end">
                                <a href="/don-hang/{{ $o->id }}" class="btn btn-outline-primary btn-sm">Xem</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
