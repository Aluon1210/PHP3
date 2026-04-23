@extends('layout')

@section('tieudetrang')
Danh sách điện thoại
@endsection

@section('noidung')
<div class="product-list">
    <div class="section-title mb-5 text-center">
        <h2 class="fw-bold" style="letter-spacing: 2px; text-transform: uppercase;">{{ $tenLoai ?? 'Sản phẩm điện thoại' }}</h2>
    </div>
    <form action="/dien-thoai" method="GET" class="mb-4 d-flex gap-2">
        <input
            type="text"
            name="keyword"
            class="form-control"
            placeholder="Tìm theo tên hoặc mô tả sản phẩm..."
            value="{{ $keyword ?? request('keyword') }}"
        >
        <button type="submit" class="btn btn-primary px-4">Tìm kiếm</button>
    </form>

    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mb-5">
        @foreach($dienthoai as $dt)
        <div class="col">
            <div class="card h-100 border rounded-0 product-card-new">
                <div class="position-relative">
                    <span class="badge bg-dark position-absolute top-0 start-0 m-2 rounded-pill" style="font-size: 10px; opacity: 0.8;">
                        <i class="bi bi-eye"></i> {{ rand(10, 100) }} view
                    </span>
                    <span class="badge bg-danger position-absolute top-0 end-0 m-2 rounded-pill" style="font-size: 10px;">
                        -{{ rand(5, 20) }}%
                    </span>
                    @php
                        $img = $dt->urlHinh ?? '';
                        if (!$img) {
                            $img = 'https://placehold.co/600x600?text=Product';
                        } elseif (!preg_match('~^https?://~i', $img) && $img[0] !== '/') {
                            $img = '/' . $img;
                        }
                    @endphp
                    <div class="product-thumb">
                        <img src="{{ $img }}" alt="{{ $dt->tenDT }}" onerror="this.onerror=null; this.src='https://placehold.co/600x600?text=Product';">
                    </div>
                </div>
                <div class="card-body p-3 text-center border-top">
                    <h5 class="card-title h6 fw-bold mb-3 text-dark">{{ $dt->tenDT }}</h5>
                    <p class="mb-1 text-muted text-decoration-line-through small">{{ number_format($dt->gia * 1.2, 0, ',', '.') }} VNĐ</p>
                    <p class="fw-bold text-primary mb-3">{{ number_format($dt->gia, 0, ',', '.') }} VNĐ</p>
                    <div class="d-flex gap-2 justify-content-center">
                        <a href="/dien-thoai/{{ $dt->id }}" class="btn btn-outline-primary btn-sm px-4">Xem chi tiết</a>
                        <form action="/gio-hang/them/{{ $dt->id }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm px-4">Thêm giỏ</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="d-flex justify-content-center mt-4 mb-5">
        {{ $dienthoai->links() }}
    </div>
</div>

<style>
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
