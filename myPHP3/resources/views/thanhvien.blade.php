@extends('layout')

@section('tieudetrang')
Thành viên hệ thống
@endsection

@section('noidung')
<div class="member-list px-2">
    <div class="section-title mb-4 border-bottom pb-2">
        <h2 class="h4 fw-bold m-0 text-uppercase" style="border-left: 5px solid var(--primary-yellow); padding-left: 15px;">Danh sách thành viên</h2>
    </div>

    <div class="row row-cols-1 row-cols-md-4 g-4 mb-5">
        @foreach($thanhvien as $tv)
        <div class="col text-center">
            <div class="card h-100 border-0 shadow-sm overflow-hidden news-card p-4">
                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 100px; height: 100px; background-color: var(--light-yellow) !important;">
                    <i class="bi bi-person-circle text-muted display-4"></i>
                </div>
                <div class="card-body p-0">
                    <h5 class="card-title h6 fw-bold mb-1 text-dark">{{ $tv->hoTen }}</h5>
                    <p class="card-text small text-muted mb-2">Email: {{ $tv->email }}</p>
                    <div class="mt-3">
                        <span class="badge rounded-pill bg-light text-dark px-3 py-2">Thành viên mới</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
