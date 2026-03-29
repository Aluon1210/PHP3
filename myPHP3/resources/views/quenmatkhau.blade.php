@extends('layout')

@section('tieudetrang')
Quên mật khẩu
@endsection

@section('noidung')
<div class="py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow border-0">
                <div class="card-header bg-warning text-dark fw-bold text-center py-3">
                    <h4 class="mb-0">QUÊN MẬT KHẨU</h4>
                </div>
                <div class="card-body p-5">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
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

                        <div class="d-grid">
                            <button type="submit" class="btn btn-warning fw-bold">GỬI YÊU CẦU</button>
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
