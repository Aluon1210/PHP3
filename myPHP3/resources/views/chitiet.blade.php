@extends('layout')

@section('tieudetrang')
{{ $tin->tieuDe ?? 'Chi tiết tin' }}
@endsection

@section('noidung')
<div class="news-detail-wrapper bg-white rounded-3 shadow-sm p-4 my-3">
    @if($tin)
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-light p-2 px-3 rounded-pill small">
                <li class="breadcrumb-item"><a href="/" class="text-decoration-none text-muted">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="/cat/{{ $tin->idLT }}" class="text-decoration-none text-muted">Danh mục</a></li>
                <li class="breadcrumb-item active text-dark" aria-current="page">{{ Str::limit($tin->tieuDe, 40) }}</li>
            </ol>
        </nav>

        <h1 class="h2 fw-bold mb-3 lh-base text-dark">{{ $tin->tieuDe }}</h1>
        
        @if($tin->urlHinh)
            <div class="main-image mb-4 rounded-4 overflow-hidden shadow-sm">
                <img src="{{ $tin->urlHinh }}" class="img-fluid w-100" style="max-height: 500px; object-fit: cover;" alt="{{ $tin->tieuDe }}" onerror="this.onerror=null; this.src='https://placehold.co/800x450?text=No+Image';">
            </div>
        @endif
        
        <div class="d-flex align-items-center gap-4 mb-4 text-muted small border-bottom pb-3">
            <div class="d-flex align-items-center"><i class="bi bi-calendar3 me-2 text-warning"></i> {{ date('d/m/Y', strtotime($tin->ngayDang)) }}</div>
            <div class="d-flex align-items-center"><i class="bi bi-eye me-2 text-warning"></i> {{ number_format($tin->xem) }} lượt xem</div>
            <div class="d-flex align-items-center ms-auto">
                <button class="btn btn-sm btn-outline-light text-dark border-0 d-flex align-items-center gap-2">
                    <i class="bi bi-share text-primary"></i> Chia sẻ
                </button>
            </div>
        </div>

        <div class="tom-tat fw-bold mb-4 p-4 bg-light rounded-4 border-start border-4 border-warning shadow-sm" style="font-size: 1.15rem; line-height: 1.6; color: #444;">
            {{ $tin->tomTat }}
        </div>

        <div class="noi-dung-chi-tiet mb-5" style="line-height: 1.9; font-size: 1.1rem; color: #333;">
            {!! $tin->noiDung !!}
        </div>

        <div class="tags-section mb-5">
            <span class="me-2 fw-bold small text-muted text-uppercase">Tags:</span>
            <span class="badge bg-light text-dark border fw-normal p-2 px-3 rounded-pill me-1">Điện thoại</span>
            <span class="badge bg-light text-dark border fw-normal p-2 px-3 rounded-pill me-1">Công nghệ</span>
            <span class="badge bg-light text-dark border fw-normal p-2 px-3 rounded-pill me-1">Review</span>
        </div>

        <div class="comment-section mt-5 pt-5 border-top">
            <div class="d-flex align-items-center gap-2 mb-4">
                <div class="bg-warning rounded-3 p-2" style="width: 4px; height: 24px;"></div>
                <h4 class="fw-bold m-0">Ý kiến bạn đọc ({{ count($binhluan) }})</h4>
            </div>
            
            @if(Session::has('user'))
                <div class="card border-0 bg-light rounded-4 mb-5 shadow-sm">
                    <div class="card-body p-4">
                        <form action="/binh-luan" method="POST">
                            @csrf
                            <input type="hidden" name="idTin" value="{{ $tin->id }}">
                            <div class="mb-3">
                                <label class="form-label fw-bold small text-muted">Bình luận của bạn</label>
                                <textarea name="noiDung" class="form-control border-0 shadow-sm rounded-3" rows="3" placeholder="Chia sẻ suy nghĩ của bạn..." required></textarea>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-warning px-4 py-2 fw-bold rounded-pill">GỬI BÌNH LUẬN <i class="bi bi-send-fill ms-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <div class="alert alert-warning border-0 rounded-4 p-4 mb-5 d-flex align-items-center gap-3">
                    <i class="bi bi-info-circle-fill fs-3"></i>
                    <div>
                        Bạn cần <a href="/dang-nhap" class="fw-bold text-dark text-decoration-none border-bottom border-dark border-2">đăng nhập</a> để tham gia thảo luận và gửi bình luận của mình.
                    </div>
                </div>
            @endif

            <div class="comment-list px-2">
                @forelse($binhluan as $bl)
                    <div class="comment-item d-flex gap-3 mb-4 p-3 rounded-4 hover-bg-light transition">
                        <div class="avatar-box flex-shrink-0">
                            <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px;">
                                <span class="fs-5 fw-bold">{{ strtoupper(substr($bl->hoTen, 0, 1)) }}</span>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="fw-bold text-dark">{{ $bl->hoTen }}</span>
                                <span class="text-muted small bg-light p-1 px-2 rounded-pill"><i class="bi bi-clock me-1"></i> {{ date('d/m/Y H:i', strtotime($bl->ngayDang)) }}</span>
                            </div>
                            <div class="comment-text text-secondary lh-base">{{ $bl->noiDung }}</div>
                            <div class="mt-2 small">
                                <a href="#" class="text-decoration-none text-muted me-3 hover-warning">Trả lời</a>
                                <a href="#" class="text-decoration-none text-muted hover-warning">Thích</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5 bg-light rounded-4">
                        <i class="bi bi-chat-dots display-4 text-muted mb-3 d-block"></i>
                        <p class="text-muted italic mb-0">Hãy là người đầu tiên bình luận cho bài viết này.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="related-news mt-5 pt-5 border-top">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center gap-2">
                    <div class="bg-warning rounded-3 p-2" style="width: 4px; height: 24px;"></div>
                    <h4 class="fw-bold m-0">Tin cùng chuyên mục</h4>
                </div>
                <a href="/cat/{{ $tin->idLT }}" class="text-decoration-none text-muted small">Xem thêm <i class="bi bi-arrow-right"></i></a>
            </div>
            
            @php
                $tinLQ = DB::table('tin')->where('idLT', $tin->idLT)->where('id', '<>', $tin->id)->limit(3)->get();
            @endphp
            <div class="row g-4">
                @foreach($tinLQ as $lq)
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm overflow-hidden news-card rounded-4 transition hover-up">
                        <div class="bg-light p-4 text-center border-bottom" style="height: 120px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-newspaper fs-1 text-muted opacity-25"></i>
                        </div>
                        <div class="card-body p-3">
                            <h6 class="card-title fw-bold mb-2 lh-base">
                                <a href="/tin/{{ $lq->id }}" class="text-decoration-none text-dark stretched-link">
                                    {{ Str::limit($lq->tieuDe, 60) }}
                                </a>
                            </h6>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="small text-muted"><i class="bi bi-calendar3 me-1"></i> {{ date('d/m/Y', strtotime($lq->ngayDang)) }}</span>
                                <span class="small text-muted"><i class="bi bi-eye"></i> {{ $lq->xem }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-search display-1 text-muted opacity-25"></i>
            <h2 class="mt-4 fw-bold">Không tìm thấy nội dung</h2>
            <p class="text-muted">Bài viết bạn đang tìm kiếm có thể đã bị gỡ bỏ hoặc chuyển sang địa chỉ khác.</p>
            <a href="/" class="btn btn-warning rounded-pill mt-3 px-5 py-2 fw-bold">Quay lại trang chủ</a>
        </div>
    @endif
</div>

<style>
.news-detail-wrapper {
    overflow: hidden;
}
.transition {
    transition: all 0.3s ease;
}
.hover-bg-light:hover {
    background-color: #f8f9fa;
}
.hover-up:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}
.hover-warning:hover {
    color: var(--primary-yellow) !important;
}
.breadcrumb-item + .breadcrumb-item::before {
    content: "\F285";
    font-family: "bootstrap-icons";
    font-size: 0.7rem;
    vertical-align: middle;
}
</style>
@endsection
