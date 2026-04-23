@extends('layout')

@section('tieudetrang')
Trang chủ - SHOP CÔNG NGHỆ
@endsection

@section('noidung')
<div class="home-shop">
    <!-- Hero Slider -->
    <div id="heroCarousel" class="carousel slide mb-5" data-bs-ride="carousel" style="background-color: #808080; border-radius: 0;">
        <div class="carousel-inner">
            @foreach($spMoi->take(4) as $index => $sp)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <div class="d-flex align-items-center justify-content-center flex-column py-5 text-white text-center">
                    @php
                        $img = $sp->urlHinh ?? '';
                        if (!$img) {
                            $img = 'https://placehold.co/400x400?text=Product';
                        } elseif (!preg_match('~^https?://~i', $img) && $img[0] !== '/') {
                            $img = '/' . $img;
                        }
                    @endphp
                    <img src="{{ $img }}" alt="{{ $sp->tenDT }}" class="mb-3" style="max-height: 250px; width: auto;" onerror="this.src='https://placehold.co/400x400?text=Product';">
                    <h2 class="h1 fw-bold mb-2">{{ $sp->tenDT }}</h2>
                    <p class="mb-4">Các sản phẩm đặc biệt và chất lượng mua ngay kẻo lỡ</p>
                    <a href="/dien-thoai/{{ $sp->id }}" class="btn btn-primary btn-lg px-5" style="border-radius: 10px;">Mua ngay!</a>
                </div>
            </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
        <div class="carousel-indicators">
            @foreach($spMoi->take(4) as $index => $sp)
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></button>
            @endforeach
        </div>
    </div>

    <div class="text-center mb-5">
        <h2 class="fw-bold" style="letter-spacing: 2px;">DANH SÁCH SẢN PHẨM</h2>
    </div>

    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
        @foreach($dienthoai as $sp)
            @php
                $gia = (float) ($sp->gia ?? 0);
                $giaKM = isset($sp->giaKM) && $sp->giaKM ? (float) $sp->giaKM : null;
                $giaHien = $giaKM && $giaKM < $gia ? $giaKM : $gia;
                $phanTram = ($giaKM && $giaKM < $gia && $gia > 0) ? round((1 - ($giaKM / $gia)) * 100) : null;
                $img = $sp->urlHinh ?? '';
                if (!$img) {
                    $img = 'https://placehold.co/600x600?text=Product';
                } elseif (!preg_match('~^https?://~i', $img) && $img[0] !== '/') {
                    $img = '/' . $img;
                }
            @endphp
            <div class="col">
                <div class="card h-100 border rounded-0 product-card-new">
                    <div class="position-relative">
                        <span class="badge bg-dark position-absolute top-0 start-0 m-2 rounded-pill" style="font-size: 10px; opacity: 0.8;">
                            {{ (int) ($sp->hot ?? 0) === 1 ? 'HOT' : 'NEW' }}
                        </span>
                        @if($phanTram)
                            <span class="badge bg-danger position-absolute top-0 end-0 m-2 rounded-pill" style="font-size: 10px;">
                                -{{ $phanTram }}%
                            </span>
                        @endif
                        <div class="product-thumb">
                            <img src="{{ $img }}" alt="{{ $sp->tenDT }}" onerror="this.onerror=null; this.src='https://placehold.co/600x600?text=Product';">
                        </div>
                    </div>
                    <div class="card-body p-3 text-center border-top">
                        <h5 class="card-title h6 fw-bold mb-3 text-dark">{{ $sp->tenDT }}</h5>
                        @if($phanTram)
                            <p class="mb-1 text-muted text-decoration-line-through small">{{ number_format($gia, 0, ',', '.') }} VNĐ</p>
                        @endif
                        <p class="fw-bold text-primary mb-3">{{ number_format($giaHien, 0, ',', '.') }} VNĐ</p>
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="/dien-thoai/{{ $sp->id }}" class="btn btn-outline-primary btn-sm px-4 product-detail-link">Xem chi tiết</a>
                            <form action="/gio-hang/them/{{ $sp->id }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm px-4">Thêm giỏ</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4 mb-3">
        {{ $dienthoai->links() }}
    </div>
</div>

<style>
.home-shop {
    padding-top: 20px;
}

#heroCarousel {
    border-radius: 0;
    overflow: hidden;
}

.carousel-item {
    background: #f4f4f4;
}

.section-title h2 {
    font-size: 28px;
    letter-spacing: 1px;
    color: var(--primary-navy);
}

.product-card-new {
    transition: var(--transition);
    background: #fff;
}

.product-card-new:hover {
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    transform: translateY(-5px);
}

.product-thumb {
    aspect-ratio: 1 / 1;
    overflow: hidden;
    background: #fff;
    padding: 20px;
}

.product-thumb img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: var(--transition);
}

.product-card-new:hover .product-thumb img {
    transform: scale(1.05);
}

.product-card-new .card-title {
    font-size: 14px;
    height: 40px;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}

.text-primary {
    color: var(--accent-red) !important;
}

.btn-primary {
    background-color: var(--primary-navy);
    border-color: var(--primary-navy);
    border-radius: 0;
    font-weight: 700;
    font-size: 12px;
    text-transform: uppercase;
}

.btn-outline-primary {
    color: var(--primary-navy);
    border-color: var(--primary-navy);
    border-radius: 0;
    font-weight: 700;
    font-size: 12px;
    text-transform: uppercase;
}

.btn-outline-primary:hover {
    background-color: var(--primary-navy);
    border-color: var(--primary-navy);
}

.badge.bg-danger {
    background-color: var(--accent-red) !important;
    border-radius: 0;
    padding: 5px 10px;
    font-weight: 800;
}

</style>
@endsection
