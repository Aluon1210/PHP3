@extends('layout')

@section('tieudetrang')
Đăng ký tài khoản
@endsection

@section('noidung')
<div class="py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow border-0">
                <div class="card-header bg-warning text-dark fw-bold text-center py-3">
                    <h4 class="mb-0">ĐĂNG KÝ TÀI KHOẢN</h4>
                </div>
                <div class="card-body p-5">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="/dang-ky" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="hoTen" class="form-label fw-semibold">Họ và tên</label>
                            <input type="text" class="form-control @error('hoTen') is-invalid @enderror" id="hoTen" name="hoTen" value="{{ old('hoTen') }}">
                            @error('hoTen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Địa chỉ Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Mật khẩu</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-semibold">Xác nhận mật khẩu</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-warning fw-bold">ĐĂNG KÝ</button>
                        </div>
                    </form>
                    <div class="mt-3 text-center">
                        <p>Đã có tài khoản? <a href="/dang-nhap" class="text-warning fw-bold text-decoration-none">Đăng nhập ngay</a></p>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection
