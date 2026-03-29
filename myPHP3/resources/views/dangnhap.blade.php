@extends('layout')

@section('tieudetrang')
Đăng nhập
@endsection

@section('noidung')
<div class="py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow border-0">
                <div class="card-header bg-warning text-dark fw-bold text-center py-3">
                    <h4 class="mb-0">ĐĂNG NHẬP</h4>
                </div>
                <div class="card-body p-5">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="/dang-nhap" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Địa chỉ Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember">
                                <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
                            </div>
                            <a href="/quen-mat-khau" class="text-decoration-none text-muted small">Quên mật khẩu?</a>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-warning fw-bold">ĐĂNG NHẬP</button>
                        </div>
                    </form>
                    <div class="mt-3 text-center">
                        <p>Chưa có tài khoản? <a href="/dang-ky" class="text-warning fw-bold text-decoration-none">Đăng ký ngay</a></p>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection
