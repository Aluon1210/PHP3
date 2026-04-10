@extends('layout')

@section('tieudetrang')
{{ $tin->tieuDe ?? 'Chi tiết tin' }}
@endsection

@section('noidung')
<div class="news-detail-wrapper bg-white rounded-0 p-4 my-3 border">
    @if($tin)
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-light p-2 px-3 rounded-0 small border">
                <li class="breadcrumb-item"><a href="/" class="text-decoration-none text-muted">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="/cat/{{ $tin->idLT }}" class="text-decoration-none text-muted">Danh mục</a></li>
                <li class="breadcrumb-item active text-dark" aria-current="page">{{ Str::limit($tin->tieuDe, 40) }}</li>
            </ol>
        </nav>

        <h1 class="h2 fw-bold mb-3 lh-base text-dark">{{ $tin->tieuDe }}</h1>
        
        @if($tin->urlHinh)
            <div class="main-image mb-4 rounded-0 overflow-hidden border">
                <img src="{{ $tin->urlHinh }}" class="img-fluid w-100" style="max-height: 500px; object-fit: cover;" alt="{{ $tin->tieuDe }}" onerror="this.onerror=null; this.src='https://placehold.co/800x450?text=No+Image';">
            </div>
        @endif
        
        <div class="d-flex align-items-center gap-4 mb-4 text-muted small border-bottom pb-3">
            <div class="d-flex align-items-center"><i class="bi bi-calendar3 me-2 text-primary"></i> {{ date('d/m/Y', strtotime($tin->ngayDang)) }}</div>
            <div class="d-flex align-items-center"><i class="bi bi-eye me-2 text-primary"></i> {{ number_format($tin->xem) }} lượt xem</div>
        </div>

        <div class="tom-tat fw-bold mb-4 p-4 bg-light rounded-0 border-start border-4 border-primary" style="font-size: 1.15rem; line-height: 1.6; color: #444;">
            {{ $tin->tomTat }}
        </div>

        <div class="noi-dung-chi-tiet mb-5" style="line-height: 1.9; font-size: 1.1rem; color: #333;">
            {!! $tin->noiDung !!}
        </div>

        <div class="comment-section mt-5 pt-5 border-top">
            <div class="d-flex align-items-center gap-2 mb-4">
                <div class="bg-primary rounded-0 p-2" style="width: 4px; height: 24px;"></div>
                <h4 class="fw-bold m-0">Ý kiến bạn đọc ({{ count($binhluan) }})</h4>
            </div>
            
            @if(Auth::check())
                <div class="card border rounded-0 bg-light mb-5">
                    <div class="card-body p-4">
                        <form action="/binh-luan" method="POST">
                            @csrf
                            <input type="hidden" name="idTin" value="{{ $tin->id }}">
                            <div class="mb-3">
                                <label class="form-label fw-bold small text-muted">Bình luận của bạn</label>
                                <textarea name="noiDung" class="form-control border rounded-0" rows="3" placeholder="Chia sẻ suy nghĩ của bạn..." required></textarea>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary px-4 py-2 fw-bold rounded-0">GỬI BÌNH LUẬN <i class="bi bi-send-fill ms-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <div class="alert alert-info border-0 rounded-0 p-4 mb-5 d-flex align-items-center gap-3">
                    <i class="bi bi-info-circle-fill fs-3"></i>
                    <div>
                        Bạn cần <a href="/dang-nhap" class="fw-bold text-dark text-decoration-none border-bottom border-dark border-2">đăng nhập</a> để tham gia thảo luận và gửi bình luận của mình.
                    </div>
                </div>
            @endif

            <div class="comment-list px-2">
                @forelse($binhluan as $bl)
                    <div class="comment-item d-flex gap-3 mb-4 p-3 rounded-0 hover-bg-light transition">
                        <div class="avatar-box flex-shrink-0">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px;">
                                <span class="fs-5 fw-bold">{{ strtoupper(substr($bl->hoTen, 0, 1)) }}</span>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="fw-bold text-dark">{{ $bl->hoTen }}</span>
                                <span class="text-muted small bg-light p-1 px-2 rounded-0"><i class="bi bi-clock me-1"></i> {{ date('d/m/Y H:i', strtotime($bl->ngayDang)) }}</span>
                            </div>
                            <div class="comment-text text-secondary lh-base">{{ $bl->noiDung }}</div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-chat-dots display-1 opacity-25"></i>
                        <p class="mt-3">Chưa có bình luận nào. Hãy là người đầu tiên chia sẻ cảm nghĩ!</p>
                    </div>
                @endforelse
            </div>
        </div>
    @endif
</div>
@endsection
