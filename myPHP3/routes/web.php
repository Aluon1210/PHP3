<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TinController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Mail\GuiEmail;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- Trang chủ & Cửa hàng (ProductController) ---
Route::get('/', [ProductController::class, 'home'])->name('home');
Route::get('/dien-thoai', [ProductController::class, 'index'])->name('product.index');
Route::get('/dien-thoai/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/loai-sp/{id}', [ProductController::class, 'byLoai'])->name('product.byLoai');

// --- Tin tức (TinController) ---
Route::get('/tin-tuc', [TinController::class, 'index'])->name('news.index');
Route::get('/tin/{id}', [TinController::class, 'chitiet'])->name('news.show');
Route::get('/loai/{idLT}', [TinController::class, 'tintrongloai'])->name('news.byCategory');
Route::get('/tim-kiem', [TinController::class, 'timkiem'])->name('search');
Route::post('/binh-luan', [TinController::class, 'binhluan'])->name('comment.store');
Route::get('/lien-he', [TinController::class, 'lienhe'])->name('contact');

// --- Giỏ hàng & Đặt hàng (ProductController) ---
Route::get('/gio-hang', [ProductController::class, 'gioHang'])->name('cart.index');
Route::post('/gio-hang/them/{id}', [ProductController::class, 'themGioHang'])->name('cart.add');
Route::post('/gio-hang/cap-nhat', [ProductController::class, 'capNhatGioHang'])->name('cart.update');
Route::get('/gio-hang/xoa/{id}', [ProductController::class, 'xoaGioHang'])->name('cart.remove');
Route::get('/gio-hang/xoa-het', [ProductController::class, 'xoaHetGioHang'])->name('cart.clear');
Route::get('/dat-hang', [ProductController::class, 'datHang'])->name('checkout');
Route::post('/dat-hang', [ProductController::class, 'datHang_'])->name('checkout.store');

// --- Xác thực & Người dùng (AuthController) ---
Route::get('/dang-ky', [AuthController::class, 'getDangKy'])->name('register');
Route::post('/dang-ky', [AuthController::class, 'postDangKy']);
Route::get('/dang-nhap', [AuthController::class, 'getDangNhap'])->name('login');
Route::post('/dang-nhap', [AuthController::class, 'postDangNhap']);
Route::get('/dang-xuat', [AuthController::class, 'dangXuat'])->name('logout');
Route::get('/kich-hoat/{token}', [AuthController::class, 'kichHoat'])->name('activate');
Route::get('/profile', [AuthController::class, 'thongTinCaNhan'])->name('profile');
Route::post('/profile', [AuthController::class, 'thongTinCaNhan_']);
Route::get('/don-hang', [AuthController::class, 'donHang'])->name('user.orders');
Route::get('/don-hang/{id}', [AuthController::class, 'chiTietDonHang'])->name('user.order.show');
Route::get('/quen-mat-khau', [AuthController::class, 'getQuenMatKhau'])->name('password.request');
Route::post('/quen-mat-khau', [AuthController::class, 'postQuenMatKhau'])->name('password.email');
Route::get('/dat-lai-mat-khau/{token}', [AuthController::class, 'getDatLaiMatKhau'])->name('password.reset');
Route::post('/dat-lai-mat-khau', [AuthController::class, 'postDatLaiMatKhau'])->name('password.update');

// --- Admin Panel (AdminController) ---
Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Quản lý Loại tin
    Route::get('/loaitin', [AdminController::class, 'loaitin_index'])->name('admin.loaitin.index');
    Route::get('/loaitin/create', [AdminController::class, 'loaitin_create'])->name('admin.loaitin.create');
    Route::post('/loaitin/store', [AdminController::class, 'loaitin_store'])->name('admin.loaitin.store');
    Route::get('/loaitin/edit/{id}', [AdminController::class, 'loaitin_edit'])->name('admin.loaitin.edit');
    Route::post('/loaitin/update/{id}', [AdminController::class, 'loaitin_update'])->name('admin.loaitin.update');
    Route::get('/loaitin/delete/{id}', [AdminController::class, 'loaitin_delete'])->name('admin.loaitin.delete');

    // Quản lý Tin
    Route::get('/tin', [AdminController::class, 'tin_index'])->name('admin.tin.index');
    Route::get('/tin/create', [AdminController::class, 'tin_create'])->name('admin.tin.create');
    Route::post('/tin/store', [AdminController::class, 'tin_store'])->name('admin.tin.store');
    Route::get('/tin/edit/{id}', [AdminController::class, 'tin_edit'])->name('admin.tin.edit');
    Route::post('/tin/update/{id}', [AdminController::class, 'tin_update'])->name('admin.tin.update');
    Route::get('/tin/delete/{id}', [AdminController::class, 'tin_delete'])->name('admin.tin.delete');

    // Quản lý Loại sản phẩm
    Route::get('/loaisp', [AdminController::class, 'loaisp_index'])->name('admin.loaisp.index');
    Route::get('/loaisp/create', [AdminController::class, 'loaisp_create'])->name('admin.loaisp.create');
    Route::post('/loaisp/store', [AdminController::class, 'loaisp_store'])->name('admin.loaisp.store');
    Route::get('/loaisp/edit/{id}', [AdminController::class, 'loaisp_edit'])->name('admin.loaisp.edit');
    Route::post('/loaisp/update/{id}', [AdminController::class, 'loaisp_update'])->name('admin.loaisp.update');
    Route::get('/loaisp/delete/{id}', [AdminController::class, 'loaisp_delete'])->name('admin.loaisp.delete');

    // Quản lý Sản phẩm
    Route::get('/sanpham', [AdminController::class, 'sanpham_index'])->name('admin.sanpham.index');
    Route::get('/sanpham/create', [AdminController::class, 'sanpham_create'])->name('admin.sanpham.create');
    Route::post('/sanpham/store', [AdminController::class, 'sanpham_store'])->name('admin.sanpham.store');
    Route::get('/sanpham/edit/{id}', [AdminController::class, 'sanpham_edit'])->name('admin.sanpham.edit');
    Route::post('/sanpham/update/{id}', [AdminController::class, 'sanpham_update'])->name('admin.sanpham.update');
    Route::get('/sanpham/delete/{id}', [AdminController::class, 'sanpham_delete'])->name('admin.sanpham.delete');

    // Quản lý Đơn hàng
    Route::get('/donhang', [AdminController::class, 'donhang_index'])->name('admin.donhang.index');
    Route::get('/donhang/{id}', [AdminController::class, 'donhang_show'])->name('admin.donhang.show');
    Route::post('/donhang/update/{id}', [AdminController::class, 'donhang_update'])->name('admin.donhang.update');
    // Backward-compatible: form in donhang_show POSTs to /admin/donhang/{id}
    Route::post('/donhang/{id}', [AdminController::class, 'donhang_update'])->name('admin.donhang.update_legacy');
    Route::get('/donhang/delete/{id}', [AdminController::class, 'donhang_delete'])->name('admin.donhang.delete');
    // Backward-compatible: link in donhang_index uses /admin/donhang-delete/{id}
    Route::get('/donhang-delete/{id}', [AdminController::class, 'donhang_delete'])->name('admin.donhang.delete_legacy');

    // Quản lý Bình luận
    Route::get('/binhluan', [AdminController::class, 'binhluan_index'])->name('admin.binhluan.index');
    Route::get('/binhluan/active/{id}/{active}', [AdminController::class, 'binhluan_active'])->name('admin.binhluan.active');
    Route::get('/binhluan/delete/{id}', [AdminController::class, 'binhluan_delete'])->name('admin.binhluan.delete');
});

// --- Breeze Routes (đã có sẵn) ---
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit_breeze');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update_breeze');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy_breeze');
});

Route::get('/send-mail', function () {
    try {
        $hasMailgunConfig = ! empty(config('services.mailgun.domain'))
            && ! empty(config('services.mailgun.secret'));
        $mailer = $hasMailgunConfig ? 'mailgun' : config('mail.default');
        $recipient = env('MAIL_TO_ADDRESS', 'duongthanhcong22112006@gmail.com');

        Mail::mailer($mailer)->to($recipient)->send(new GuiEmail());

        return 'Email đã được gửi thành công qua ' . $mailer . '!';
    } catch (\Throwable $e) {
        return 'Có lỗi xảy ra khi gửi email: ' . $e->getMessage();
    }
});
require __DIR__ . '/auth.php';
