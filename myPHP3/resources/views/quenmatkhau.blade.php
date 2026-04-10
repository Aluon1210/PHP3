@extends('layout')

@section('tieudetrang')
Quên mật khẩu
@endsection

@section('noidung')
<div class="py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow border-0 overflow-hidden">
                <div class="card-header text-white fw-bold text-center py-4" style="background-color: var(--primary-navy);">
                    <h4 class="mb-0 text-uppercase">QUÊN MẬT KHẨU</h4>
                </div>
                <div class="card-body p-5">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('reset_link'))
                        <div class="alert alert-warning">
                            <div class="fw-bold mb-1">Link đặt lại mật khẩu:</div>
                            <a href="{{ session('reset_link') }}">{{ session('reset_link') }}</a>
                        </div>
                    @endif

                    <form action="/quen-mat-khau" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Nhập Email của bạn</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn-navy py-2">GỬI YÊU CẦU</button>
                        </div>
                    </form>
                    <div class="mt-3 text-center">
                        <a href="/dang-nhap" class="text-muted text-decoration-none small">Quay lại Đăng nhập</a>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection
