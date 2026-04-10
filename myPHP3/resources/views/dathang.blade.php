@extends('layout')

@section('tieudetrang')
Đặt hàng
@endsection

@section('noidung')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 fw-bold m-0">Xác nhận đặt hàng</h1>
        <a href="/gio-hang" class="btn btn-outline-secondary btn-sm">Quay lại giỏ hàng</a>
    </div>

    @php
        $total = 0;
    @endphp

    <div class="border bg-white p-4 mb-3">
        <h2 class="h6 fw-bold mb-3">Thông tin nhận hàng</h2>
        <form action="/dat-hang" method="POST" class="row g-3">
            @csrf
            <div class="col-md-6">
                <label class="form-label fw-bold">Họ tên</label>
                <input type="text" name="hoTen" class="form-control" value="{{ $u->hoTen ?? ($u->name ?? '') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $u->email ?? '' }}">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Số điện thoại</label>
                <input type="text" name="sdt" class="form-control" value="">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Địa chỉ</label>
                <input type="text" name="diaChi" class="form-control" value="">
            </div>
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary px-5">Xác nhận mua hàng</button>
            </div>
        </form>
    </div>

    <div class="border bg-white p-4">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Sản phẩm</th>
                        <th style="width: 140px;" class="text-center">Số lượng</th>
                        <th style="width: 160px;" class="text-end">Tạm tính</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $item)
                        @php
                            $price = isset($item['giaKM']) && $item['giaKM'] ? $item['giaKM'] : $item['gia'];
                            $sub = $price * $item['qty'];
                            $total += $sub;
                        @endphp
                        <tr>
                            <td class="fw-bold">{{ $item['tenDT'] }}</td>
                            <td class="text-center">{{ $item['qty'] }}</td>
                            <td class="text-end fw-bold">{{ number_format($sub, 0, ',', '.') }} VNĐ</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <td colspan="2" class="text-end fw-bold">Tổng cộng</td>
                        <td class="text-end fw-bold text-primary">{{ number_format($total, 0, ',', '.') }} VNĐ</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
