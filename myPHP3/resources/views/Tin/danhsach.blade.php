@extends('layout')

@section('noidung')
<div class="container">
    <h1 class="mb-4">Tin tức</h1>
    @foreach ($data as $tin)
        <div class="row mb-4 pb-4 border-bottom">
            <div class="col-md-9">
                <div class="text-muted small mb-1">
                    @if(!empty($tin->tenLoai))
                        <a href="/cat/{{ $tin->idLT }}" class="text-decoration-none">{{ $tin->tenLoai }}</a>
                        <span class="mx-2">|</span>
                    @endif
                    <span>{{ $tin->ngayDang ?? '' }}</span>
                </div>
                <h4 class="fw-bold mb-2">
                    <a class="text-decoration-none text-dark" href="/chi-tiet/{{ $tin->id }}">{{ $tin->tieuDe }}</a>
                </h4>
                <p class="text-muted mb-0">{{ $tin->tomTat }}</p>
            </div>
            <div class="col-md-3 text-end d-flex align-items-center justify-content-end">
                <a href="/chi-tiet/{{ $tin->id }}" class="btn btn-outline-primary btn-sm px-4">Xem chi tiết</a>
            </div>
        </div>
    @endforeach

    <div class="d-flex justify-content-center">
        {{ $data->links() }}
    </div>
</div>
@endsection
