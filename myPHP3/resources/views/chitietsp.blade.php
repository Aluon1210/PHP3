@extends('layout')

@section('tieudetrang')
{{ $sp->tenDT ?? 'Chi tiết sản phẩm' }}
@endsection

@section('noidung')
<div class="row g-4">
    <div class="col-md-7">
        <div class="border bg-white p-4 text-center">
            @php
                $img = $sp->urlHinh ?? '';
                if (!$img) {
                    $img = 'https://placehold.co/600x600?text=Product';
                } elseif (!preg_match('~^https?://~i', $img) && $img[0] !== '/') {
                    $img = '/' . $img;
                }
            @endphp
            <img src="{{ $img }}" class="img-fluid d-block mx-auto" style="width: 100%; max-height: 560px; object-fit: contain;" alt="{{ $sp->tenDT }}" onerror="this.onerror=null; this.src='https://placehold.co/600x600?text=Product';">
        </div>
    </div>
    <div class="col-md-5">
        <h1 class="h3 fw-bold mb-3">{{ $sp->tenDT }}</h1>
        @if($loai)
            <div class="text-muted mb-2">Danh mục: <a class="text-decoration-none" href="/loai-sp/{{ $loai->id }}">{{ $loai->tenLoai }}</a></div>
        @endif
        <div class="d-flex align-items-baseline gap-3 mb-4">
            <div class="h4 fw-bold text-primary mb-0">{{ number_format($sp->gia, 0, ',', '.') }} VNĐ</div>
            <div class="text-muted text-decoration-line-through">{{ number_format($sp->gia * 1.2, 0, ',', '.') }} VNĐ</div>
        </div>

        <form action="/gio-hang/them/{{ $sp->id }}" method="POST" class="d-flex align-items-end gap-3 mb-4">
            @csrf
            <div style="max-width: 120px;">
                <label class="form-label fw-bold">Số lượng</label>
                <input type="number" min="1" name="qty" value="1" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary px-5">Thêm vào giỏ hàng</button>
            <a href="/gio-hang" class="btn btn-outline-primary px-4">Xem giỏ</a>
        </form>

        <div class="border-top pt-3">
            <h2 class="h5 fw-bold mb-3">Mô tả</h2>
            <div class="text-muted" style="line-height: 1.8;">
                {{ $sp->moTa ?? 'Chưa có mô tả.' }}
            </div>
        </div>
    </div>
</div>

<div class="comment-section mt-5 pt-4 border-top">
    <h2 class="h5 fw-bold mb-3">Bình luận sản phẩm ({{ count($binhluan ?? []) }})</h2>

    @if(Auth::check())
        <form action="/binh-luan-san-pham" method="POST" class="mb-4">
            @csrf
            <input type="hidden" name="idSP" value="{{ $sp->id }}">
            <div class="mb-2">
                <textarea name="noiDung" class="form-control" rows="3" placeholder="Nhập bình luận của bạn..." required>{{ old('noiDung') }}</textarea>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Gửi bình luận</button>
            </div>
        </form>
    @else
        <div class="alert alert-info">
            Vui lòng <a href="/dang-nhap">đăng nhập</a> để bình luận sản phẩm.
        </div>
    @endif

    <div class="mt-3">
        @forelse(($binhluan ?? []) as $bl)
            <div class="border rounded p-3 mb-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <strong>{{ $bl->hoTen }}</strong>
                    <span class="text-muted small">{{ date('d/m/Y H:i', strtotime($bl->ngayDang)) }}</span>
                </div>
                <div class="text-muted">{{ $bl->noiDung }}</div>
            </div>
        @empty
            <p class="text-muted">Chưa có bình luận nào cho sản phẩm này.</p>
        @endforelse
    </div>
</div>
@endsection
