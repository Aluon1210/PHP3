@extends('layout')

@section('tieudetrang')
Tìm kiếm: {{ $keyword }}
@endsection

@section('noidung')
<div class="search-results px-2">
    <div class="section-title mb-4 border-bottom pb-2">
        <h2 class="h4 fw-bold m-0 text-uppercase" style="border-left: 5px solid var(--primary-yellow); padding-left: 15px;">Kết quả tìm kiếm cho: "{{ $keyword }}"</h2>
    </div>

    <!-- Kết quả Sản phẩm -->
    <div class="mb-5">
        <h5 class="fw-bold mb-3"><i class="bi bi-phone me-2 text-warning"></i>SẢN PHẨM ({{ count($listsp) }})</h5>
        @if(count($listsp) > 0)
            <div class="row row-cols-1 row-cols-md-4 g-4">
                @foreach($listsp as $sp)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm product-card text-center">
                        <div class="bg-light d-flex align-items-center justify-content-center p-3" style="height: 150px;">
                            <i class="bi bi-phone text-muted display-6"></i>
                        </div>
                        <div class="card-body p-2">
                            <h6 class="card-title fw-bold mb-1 text-dark small">{{ $sp->tenDT }}</h6>
                            <p class="card-text fw-bold text-danger mb-2 small">{{ number_format($sp->gia, 0, ',', '.') }} đ</p>
                            <a href="/dien-thoai/{{ $sp->id }}" class="btn btn-xs btn-yellow w-100 py-1 fw-bold" style="font-size: 11px;">Chi tiết</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <p class="text-muted small ms-4">Không tìm thấy sản phẩm nào phù hợp.</p>
        @endif
    </div>

    <!-- Kết quả Tin tức -->
    <div class="mb-5">
        <h5 class="fw-bold mb-3"><i class="bi bi-newspaper me-2 text-warning"></i>TIN TỨC ({{ count($listtin) }})</h5>
        @if(count($listtin) > 0)
            <div class="list-group list-group-flush">
                @foreach($listtin as $tin)
                <a href="/tin/{{ $tin->id }}" class="list-group-item list-group-item-action border-0 px-0 py-3 d-flex align-items-start gap-3">
                    <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 80px; height: 60px; flex-shrink: 0;">
                        <i class="bi bi-image text-muted"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1 text-dark">{{ $tin->tieuDe }}</h6>
                        <p class="small text-muted mb-0">{{ Str::limit($tin->tomTat, 150) }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        @else
            <p class="text-muted small ms-4">Không tìm thấy tin tức nào phù hợp.</p>
        @endif
    </div>

    @if(count($listsp) == 0 && count($listtin) == 0)
        <div class="text-center py-5">
            <i class="bi bi-search display-1 text-muted"></i>
            <p class="mt-3 text-muted">Rất tiếc, chúng tôi không tìm thấy nội dung nào khớp với từ khóa của bạn.</p>
        </div>
    @endif
</div>
@endsection
