@extends('layout')

@section('tieudetrang')
Tin tức mới nhất
@endsection

@section('noidung')
<div class="news-list px-2">
    <div class="section-title mb-4 border-bottom pb-2">
        <h2 class="h4 fw-bold m-0 text-uppercase" style="border-left: 5px solid var(--primary-yellow); padding-left: 15px;">Tin tức mới nhất</h2>
    </div>

    <div class="row row-cols-1 row-cols-md-4 g-4 mb-5">
        @foreach($data as $item)
        <div class="col">
            <div class="card h-100 border-0 shadow-sm overflow-hidden news-card text-center">
                <div class="bg-light d-flex align-items-center justify-content-center p-4" style="height: 160px;">
                    <i class="bi bi-newspaper text-muted display-4"></i>
                </div>
                <div class="card-body p-3">
                    <h5 class="card-title h6 fw-bold mb-2 text-dark">
                        <a href="/tin/{{ $item->id }}" class="text-decoration-none text-dark hover-yellow">
                            {{ Str::limit($item->tieuDe, 60) }}
                        </a>
                    </h5>
                    <p class="card-text small text-muted mb-0">
                        <i class="bi bi-calendar3 me-1"></i> {{ date('d/m/Y', strtotime($item->ngayDang)) }}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    .news-card {
        transition: all 0.3s ease;
    }
    .news-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .hover-yellow:hover {
        color: var(--primary-yellow) !important;
    }
</style>
@endsection