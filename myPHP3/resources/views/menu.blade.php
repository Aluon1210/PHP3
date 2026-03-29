<?php
    $loaitin = DB::table('loaitin')
        ->where('AnHien', 1)
        ->orderBy('thuTu', 'asc')
        ->get();
?>
<div class="nav-container px-3">
    <ul class="nav-items d-flex align-items-center list-unstyled m-0">
        <li class="nav-item">
            <a href="/" class="nav-link-custom">
                <i class="bi bi-house-door"></i>
                <span>Trang chủ</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="/dien-thoai" class="nav-link-custom">
                <i class="bi bi-phone"></i>
                <span>Điện thoại</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="/loai-sp" class="nav-link-custom">
                <i class="bi bi-grid"></i>
                <span>Loại SP</span>
            </a>
        </li>
        @foreach($loaitin as $lt)
        <li class="nav-item">
            <a href="/cat/{{ $lt->id }}" class="nav-link-custom">
                <i class="bi bi-tag"></i>
                <span>{{ $lt->ten }}</span>
            </a>
        </li>
        @endforeach
        <li class="nav-item">
            <a href="/tinmoi" class="nav-link-custom">
                <i class="bi bi-clock-history"></i>
                <span>Tin mới</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="/txn" class="nav-link-custom">
                <i class="bi bi-graph-up-arrow"></i>
                <span>Xem nhiều</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="/thanh-vien" class="nav-link-custom">
                <i class="bi bi-people"></i>
                <span>Thành viên</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="/lien-he" class="nav-link-custom">
                <i class="bi bi-chat-dots"></i>
                <span>Liên hệ</span>
            </a>
        </li>
    </ul>
</div>

<style>
    .nav-container {
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
    }
    .nav-items {
        gap: 2px;
        justify-content: flex-start;
        overflow-x: auto;
        white-space: nowrap;
        scrollbar-width: none; /* Firefox */
    }
    .nav-items::-webkit-scrollbar {
        display: none; /* Chrome, Safari, Opera */
    }
    .nav-link-custom {
        display: flex;
        align-items: center;
        gap: 6px;
        color: #333;
        text-decoration: none;
        padding: 12px 12px;
        font-size: 13px;
        font-weight: 500;
        border-radius: 4px;
        transition: all 0.2s;
    }
    .nav-link-custom:hover {
        background-color: rgba(255,255,255,0.3);
        color: #000;
    }
    .nav-link-custom i {
        font-size: 18px;
    }
</style>