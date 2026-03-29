@extends('layout')

@section('tieudetrang')
Đặt lại mật khẩu
@endsection

@section('noidung')
<div class="py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow border-0">
                <div class="card-header bg-warning text-dark fw-bold text-center py-3">
                    <h4 class="mb-0">ĐẶT LẠI MẬT KHẨU</h4>
                </div>
                <div class="card-body p-5">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="/dat-lai-mat-khau" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Mật khẩu mới</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-semibold">Xác nhận mật khẩu mới</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-warning fw-bold">CẬP NHẬT MẬT KHẨU</button>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>
@endsection
