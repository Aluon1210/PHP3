@extends('layout')

@section('tieudetrang')
Trang chủ - Cửa hàng điện thoại thông minh
@endsection

@section('noidung')
<div class="home-shop px-2">
    <!-- Danh mục nhanh -->
    <div class="section-title mb-4 border-bottom pb-2">
        <h2 class="h4 fw-bold m-0 text-uppercase"
            style="border-left: 5px solid var(--primary-yellow); padding-left: 15px;">Thương hiệu nổi bật</h2>
    </div>
    <div class="row g-3 mb-5">
        @foreach($loaiSP as $loai)
        <div class="col-6 col-md-3">
            <a href="/loai-sp/{{ $loai->id }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm py-3 text-center brand-card hover-yellow"
                    style="background-color: var(--light-yellow);">
                    <h6 class="fw-bold m-0 text-dark">{{ $loai->tenLoai }}</h6>
                </div>
            </a>
        </div>
        @endforeach
    </div>

    <!-- Sản phẩm mới nhất -->
    <div class="section-title mb-4 border-bottom pb-2 d-flex justify-content-between align-items-end">
        <h2 class="h4 fw-bold m-0 text-uppercase"
            style="border-left: 5px solid var(--primary-yellow); padding-left: 15px;">Điện thoại mới nhất</h2>
        <a href="/dien-thoai" class="text-decoration-none small text-muted">Xem tất cả <i
                class="bi bi-arrow-right"></i></a>
    </div>

    <div class="row row-cols-1 row-cols-md-4 g-4 mb-5">
        @foreach($spMoi as $sp)
        <div class="col">
            <div class="card h-100 border-0 shadow-sm overflow-hidden product-card text-center">
                <div class="bg-light d-flex align-items-center justify-content-center overflow-hidden" style="height: 180px;">
                    @if($sp->urlHinh)
                        <img src="{{ $sp->urlHinh }}" class="img-fluid h-100 w-100" style="object-fit: cover;" alt="{{ $sp->tenDT }}" onerror="this.src='https://placehold.co/400x300?text=Sản+Phẩm';">
                    @else
                        <i class="bi bi-phone text-muted display-4"></i>
                    @endif
                </div>
                <div class="card-body p-3">
                    <h5 class="card-title h6 fw-bold mb-2 text-dark">{{ $sp->tenDT }}</h5>
                    <p class="card-text fw-bold text-danger mb-3">{{ number_format($sp->gia, 0, ',', '.') }} VNĐ</p>
                    <a href="/dien-thoai" class="btn btn-sm btn-yellow w-100 py-2 fw-bold">Xem chi tiết</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Deal hot -->
    <!-- <div class="hot-deal p-5 rounded-4 mb-5 shadow-sm text-white" style="background: linear-gradient(135deg, #FFC107 0%, #E6B800 100%);">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h3 class="fw-bold mb-2">SIÊU ƯU ĐÃI THÁNG 3!</h3>
                <p class="mb-0">Các dòng điện thoại tầm trung dưới 5 triệu đồng đang có giá tốt nhất năm.</p>
            </div>
            <div class="col-md-4 text-end">
                <a href="/dien-thoai" class="btn btn-dark btn-lg px-4">KHÁM PHÁ NGAY</a>
            </div>
        </div>
    </div> -->
</div>

<style>
.product-card {
    transition: all 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
}

.brand-card {
    transition: all 0.2s ease;
}

.brand-card:hover {
    transform: scale(1.05);
    background-color: var(--primary-yellow) !important;
}
</style>
@endsection