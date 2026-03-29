@extends('layout')

@section('tieudetrang')
Danh sách điện thoại
@endsection

@section('noidung')
<div class="product-list px-2">
    <div class="section-title mb-4 border-bottom pb-2">
        <h2 class="h4 fw-bold m-0 text-uppercase" style="border-left: 5px solid var(--primary-yellow); padding-left: 15px;">Sản phẩm điện thoại</h2>
    </div>

    <div class="row row-cols-1 row-cols-md-4 g-4 mb-5">
        @foreach($dienthoai as $dt)
        <div class="col">
            <div class="card h-100 border-0 shadow-sm overflow-hidden news-card">
                <div class="bg-light d-flex align-items-center justify-content-center overflow-hidden" style="height: 200px;">
                    @if($dt->urlHinh)
                        <img src="{{ $dt->urlHinh }}" class="img-fluid h-100 w-100" style="object-fit: cover;" alt="{{ $dt->tenDT }}" onerror="this.onerror=null; this.src='https://placehold.co/400x300?text=No+Image';">
                    @else
                        <i class="bi bi-phone text-muted display-4"></i>
                    @endif
                </div>
                <div class="card-body p-3">
                    <h5 class="card-title h6 fw-bold mb-2 text-dark">{{ $dt->tenDT }}</h5>
                    <p class="card-text fw-bold text-danger mb-2">{{ number_format($dt->gia, 0, ',', '.') }} VNĐ</p>
                    <a href="#" class="btn btn-sm btn-yellow w-100">Xem chi tiết</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="d-flex justify-content-center mt-4 mb-5">
        {{ $dienthoai->links() }}
    </div>
</div>
@endsection
