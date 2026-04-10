@extends('layout')

@section('tieudetrang')
Giỏ hàng
@endsection

@section('noidung')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 fw-bold m-0">Giỏ hàng</h1>
        <a href="/dien-thoai" class="btn btn-outline-primary btn-sm">Tiếp tục mua sắm</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 rounded-0">{{ session('success') }}</div>
    @endif

    @php
        $total = 0;
    @endphp

    @if(empty($cart))
        <div class="border bg-white p-5 text-center text-muted">
            <div class="display-6 mb-2"><i class="bi bi-cart3"></i></div>
            <div>Giỏ hàng đang trống.</div>
        </div>
    @else
        <form action="/gio-hang/cap-nhat" method="POST">
            @csrf
            <div class="table-responsive border bg-white">
                <table class="table mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 90px;">Ảnh</th>
                            <th>Sản phẩm</th>
                            <th style="width: 160px;" class="text-end">Đơn giá</th>
                            <th style="width: 140px;" class="text-center">Số lượng</th>
                            <th style="width: 160px;" class="text-end">Tạm tính</th>
                            <th style="width: 90px;" class="text-end">Xóa</th>
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
                                <td class="text-center">
                                    @php
                                        $img = $item['urlHinh'] ?? '';
                                        if (!$img) {
                                            $img = 'https://placehold.co/64x64?text=IMG';
                                        } elseif (!preg_match('~^https?://~i', $img) && $img[0] !== '/') {
                                            $img = '/' . $img;
                                        }
                                    @endphp
                                    <img src="{{ $img }}" alt="{{ $item['tenDT'] }}" style="width: 64px; height: 64px; object-fit: cover;" onerror="this.onerror=null; this.src='https://placehold.co/64x64?text=IMG';">
                                </td>
                                <td>
                                    <a href="/dien-thoai/{{ $item['id'] }}" class="text-decoration-none fw-bold text-dark">{{ $item['tenDT'] }}</a>
                                </td>
                                <td class="text-end fw-bold text-primary">
                                    {{ number_format($price, 0, ',', '.') }} VNĐ
                                </td>
                                <td class="text-center">
                                    <div class="input-group" style="max-width: 140px; margin: 0 auto;">
                                        <button class="btn btn-outline-secondary cart-qty-btn" type="button" data-action="minus" data-id="{{ $item['id'] }}">-</button>
                                        <input type="number" min="0" name="qty[{{ $item['id'] }}]" value="{{ $item['qty'] }}" class="form-control text-center cart-qty-input" data-id="{{ $item['id'] }}">
                                        <button class="btn btn-outline-secondary cart-qty-btn" type="button" data-action="plus" data-id="{{ $item['id'] }}">+</button>
                                    </div>
                                </td>
                                <td class="text-end fw-bold">
                                    {{ number_format($sub, 0, ',', '.') }} VNĐ
                                </td>
                                <td class="text-end">
                                    <a href="/gio-hang/xoa/{{ $item['id'] }}" class="btn btn-outline-danger btn-sm">Xóa</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td colspan="4" class="text-end fw-bold">Tổng cộng</td>
                            <td class="text-end fw-bold text-primary">{{ number_format($total, 0, ',', '.') }} VNĐ</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <a href="/gio-hang/xoa-het" class="btn btn-outline-secondary">Xóa hết</a>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-outline-primary px-4">Cập nhật giỏ</button>
                    <a href="/dat-hang" class="btn btn-primary px-5">Mua hàng</a>
                </div>
            </div>
        </form>
    @endif
</div>

<script>
    $(function () {
        $(document).on('click', '.cart-qty-btn', function () {
            var id = $(this).data('id');
            var action = $(this).data('action');
            var $input = $('.cart-qty-input[data-id="' + id + '"]');
            var current = parseInt($input.val() || '0', 10);
            if (action === 'plus') {
                $input.val(current + 1);
            } else if (action === 'minus') {
                $input.val(Math.max(0, current - 1));
            }
        });
    });
</script>
@endsection
