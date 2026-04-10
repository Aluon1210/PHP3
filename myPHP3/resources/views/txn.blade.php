@extends('layout')

@section('tieudetrang')
Tin xem nhiều nhất
@endsection

@section('noidung')
<div class="news-list px-2">
    <div class="section-title mb-4 border-bottom pb-2">
        <h2 class="h4 fw-bold m-0 text-uppercase" style="border-left: 5px solid var(--primary-blue); padding-left: 15px;">Tin xem nhiều nhất</h2>
    </div>

    <div class="row row-cols-1 row-cols-md-4 g-4 mb-5">
        @foreach($data as $tin)
        <div class="col">
            <div class="card h-100 border-0 shadow-sm overflow-hidden news-card text-center">
                <div class="bg-light d-flex align-items-center justify-content-center p-4" style="height: 160px;">
                    <i class="bi bi-eye text-muted display-4"></i>
                </div>
                <div class="card-body p-3">
                    <h5 class="card-title h6 fw-bold mb-2 text-dark">
                        <a href="/tin/{{ $tin->id }}" class="text-decoration-none text-dark hover-blue">
                            {{ Str::limit($tin->tieuDe, 60) }}
                        </a>
                    </h5>
                    <p class="card-text small text-muted mb-0">
                        <i class="bi bi-bar-chart-line me-1"></i> {{ $tin->xem }} lượt xem
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
    .hover-blue:hover {
        color: var(--primary-blue) !important;
    }
</style>
@endsection