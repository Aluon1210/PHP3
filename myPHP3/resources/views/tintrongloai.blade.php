@extends('layout')

@section('tieudetrang')
Loại tin: {{ $tenloai ?? 'Danh sách' }}
@endsection

@section('noidung')
<div class="category-page px-3">
    <div class="section-title mb-4 border-bottom pb-2">
        <h2 class="h4 fw-bold m-0 text-uppercase" style="border-left: 5px solid var(--primary-blue); padding-left: 15px;">
            {{ $tenloai ?? 'Danh sách tin' }}
        </h2>
    </div>

    @if(count($listtin) > 0)
    <div class="news-list">
        @foreach($listtin as $tin)
        <div class="news-item mb-5 pb-4 border-bottom">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="bg-light d-flex align-items-center justify-content-center rounded-3 overflow-hidden" style="height: 180px;">
                        @if($tin->urlHinh)
                            <img src="{{ $tin->urlHinh }}" class="img-fluid h-100 w-100" style="object-fit: cover;" alt="{{ $tin->tieuDe }}" onerror="this.src='https://placehold.co/400x300?text=Tin+Tức';">
                        @else
                            <i class="bi bi-image text-muted display-4"></i>
                        @endif
                    </div>
                </div>
                <div class="col-md-8">
                    <h3 class="h5 fw-bold mb-2">
                        <a href="/chi-tiet/{{ $tin->id }}" class="text-decoration-none text-dark">
                            {{ $tin->tieuDe }}
                        </a>
                    </h3>
                    <div class="d-flex align-items-center gap-3 text-muted small mb-2">
                        <span><i class="bi bi-calendar3 me-1"></i> {{ $tin->ngayDang ? date('d/m/Y', strtotime($tin->ngayDang)) : '' }}</span>
                        <span><i class="bi bi-eye me-1"></i> {{ $tin->xem }} lượt xem</span>
                    </div>
                    <p class="text-muted mb-3" style="font-size: 0.95rem; line-height: 1.6;">
                        {{ \Illuminate\Support\Str::limit($tin->tomTat, 200) }}
                    </p>
                    <a href="/chi-tiet/{{ $tin->id }}" class="btn btn-sm btn-outline-primary fw-bold px-3">
                        Xem tiếp <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="d-flex justify-content-center mt-5">
        {{ $listtin->links() }}
    </div>
    @else
    <div class="text-center py-5">
        <i class="bi bi-inbox display-1 text-muted"></i>
        <p class="mt-3 text-muted">Chưa có tin nào trong danh mục này.</p>
    </div>
    @endif
</div>
@endsection
