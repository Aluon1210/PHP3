@extends('layout')

@section('tieudetrang')
Đăng ký tài khoản
@endsection

@section('noidung')
<div class="py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow border-0 overflow-hidden">
                <div class="card-header text-white fw-bold text-center py-4" style="background-color: var(--primary-navy);">
                    <h4 class="mb-0 text-uppercase">ĐĂNG KÝ TÀI KHOẢN</h4>
                </div>
                <div class="card-body p-5">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="/dang-ky" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="hoTen" class="form-label fw-semibold">Họ và tên</label>
                            <input type="text" class="form-control @error('hoTen') is-invalid @enderror" id="hoTen"
                                name="hoTen" value="{{ old('hoTen') }}">
                            @error('hoTen')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label fw-semibold">Số điện thoại</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                name="phone" value="{{ old('phone') }}">
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Địa chỉ Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email') }}">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nghenghiep" class="form-label fw-semibold">Nghề nghiệp</label>
                            <input type="text" class="form-control @error('nghenghiep') is-invalid @enderror"
                                id="nghenghiep" name="nghenghiep" value="{{ old('nghenghiep') }}">
                            @error('nghenghiep')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phai" class="form-label fw-semibold">Phái</label>
                            <select class="form-select @error('phai') is-invalid @enderror" id="phai" name="phai">
                                <option value="">Chọn phái</option>
                                <option value="Nam" {{ old('phai') === 'Nam' ? 'selected' : '' }}>Nam</option>
                                <option value="Nữ" {{ old('phai') === 'Nữ' ? 'selected' : '' }}>Nữ</option>
                            </select>
                            @error('phai')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Mật khẩu</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password">
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-semibold">Xác nhận mật khẩu</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation">
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn-navy py-2">ĐĂNG KÝ</button>
                        </div>
                    </form>
                    <div class="mt-4 text-center">
                        <p class="text-muted small">Đã có tài khoản? <a href="/dang-nhap" class="fw-bold text-decoration-none" style="color: var(--accent-red);">Đăng nhập ngay</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection