@extends('layout')

@section('tieudetrang')
{{ $sp->tenDT ?? 'Chi tiết sản phẩm' }}
@endsection

@section('noidung')
<div class="row g-4">
    <div class="col-md-5">
        <div class="border bg-white p-4 text-center">
            @php
                $img = $sp->urlHinh ?? '';
                if (!$img) {
                    $img = 'https://placehold.co/600x600?text=Product';
                } elseif (!preg_match('~^https?://~i', $img) && $img[0] !== '/') {
                    $img = '/' . $img;
                }
            @endphp
            <img src="{{ $img }}" class="img-fluid" style="max-height: 420px;" alt="{{ $sp->tenDT }}" onerror="this.onerror=null; this.src='https://placehold.co/600x600?text=Product';">
        </div>
    </div>
    <div class="col-md-7">
        <h1 class="h3 fw-bold mb-3">{{ $sp->tenDT }}</h1>
        @if($loai)
            <div class="text-muted mb-2">Danh mục: <a class="text-decoration-none" href="/loai-sp/{{ $loai->id }}">{{ $loai->tenLoai }}</a></div>
        @endif
        <div class="d-flex align-items-baseline gap-3 mb-4">
            <div class="h4 fw-bold text-primary mb-0">{{ number_format($sp->gia, 0, ',', '.') }} VNĐ</div>
            <div class="text-muted text-decoration-line-through">{{ number_format($sp->gia * 1.2, 0, ',', '.') }} VNĐ</div>
        </div>

        <form action="/gio-hang/them/{{ $sp->id }}" method="POST" class="d-flex align-items-end gap-3 mb-4">
            @csrf
            <div style="max-width: 120px;">
                <label class="form-label fw-bold">Số lượng</label>
                <input type="number" min="1" name="qty" value="1" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary px-5">Thêm vào giỏ hàng</button>
            <a href="/gio-hang" class="btn btn-outline-primary px-4">Xem giỏ</a>
        </form>

        <div class="border-top pt-3">
            <h2 class="h5 fw-bold mb-3">Mô tả</h2>
            <div class="text-muted" style="line-height: 1.8;">
                {{ $sp->moTa ?? 'Chưa có mô tả.' }}
            </div>
        </div>
    </div>
</div>
@endsection
