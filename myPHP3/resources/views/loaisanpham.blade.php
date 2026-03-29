@extends('layout')

@section('tieudetrang')
Loại sản phẩm
@endsection

@section('noidung')
<div class="category-list px-2">
    <div class="section-title mb-4 border-bottom pb-2">
        <h2 class="h4 fw-bold m-0 text-uppercase" style="border-left: 5px solid var(--primary-yellow); padding-left: 15px;">Danh mục loại sản phẩm</h2>
    </div>

    <div class="row row-cols-1 row-cols-md-2 g-4 mb-5">
        @foreach($loaisp as $loai)
        <div class="col">
            <div class="card h-100 border-0 shadow-sm overflow-hidden news-card">
                <div class="card-body p-3 d-flex align-items-center gap-3">
                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: var(--light-yellow) !important;">
                        <i class="bi bi-tag text-warning fs-3"></i>
                    </div>
                    <div>
                        <h5 class="card-title h6 fw-bold mb-1 text-dark text-uppercase">{{ $loai->tenLoai }}</h5>
                        <a href="#" class="text-decoration-none small text-muted hover-yellow">Xem các sản phẩm <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
