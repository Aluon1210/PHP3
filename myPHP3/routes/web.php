<?php

use App\Http\Controllers\TinController;
use App\Http\Controllers\QtTinController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

// ... existing news routes ...
Route::get('/', [ProductController::class, 'home']);
Route::get('/tin/{id}', [TinController::class, 'chitiet']);
Route::post('/binh-luan', [TinController::class, 'binhluan']);
Route::get('/cat/{idLT}', [TinController::class, 'tintrongloai']);

// Admin Panel Routes
Route::prefix('admin')->group(function () {
    Route::get('/loaitin', [AdminController::class, 'loaitin_index']);
    Route::get('/loaitin/create', [AdminController::class, 'loaitin_create']);
    Route::post('/loaitin/store', [AdminController::class, 'loaitin_store']);
    Route::get('/loaitin/edit/{id}', [AdminController::class, 'loaitin_edit']);
    Route::post('/loaitin/update/{id}', [AdminController::class, 'loaitin_update']);
    Route::get('/loaitin/delete/{id}', [AdminController::class, 'loaitin_delete']);

    Route::get('/tin', [AdminController::class, 'tin_index']);
    Route::get('/tin/create', [AdminController::class, 'tin_create']);
    Route::post('/tin/store', [AdminController::class, 'tin_store']);
    Route::get('/tin/edit/{id}', [AdminController::class, 'tin_edit']);
    Route::post('/tin/update/{id}', [AdminController::class, 'tin_update']);
    Route::get('/tin/delete/{id}', [AdminController::class, 'tin_delete']);
});
Route::get('/dien-thoai', [ProductController::class, 'index']);
Route::get('/loai-sp', [ProductController::class, 'loaisp']);
Route::get('/thanh-vien', [ProductController::class, 'thanhvien']);

Route::get('/tim-kiem', [TinController::class, 'timkiem']);

// Auth Routes
Route::get('/dang-ky', [AuthController::class, 'getDangKy']);
Route::post('/dang-ky', [AuthController::class, 'postDangKy']);
Route::get('/dang-nhap', [AuthController::class, 'getDangNhap']);
Route::post('/dang-nhap', [AuthController::class, 'postDangNhap']);
Route::get('/dang-xuat', [AuthController::class, 'dangXuat']);
Route::get('/kich-hoat/{token}', [AuthController::class, 'kichHoat']);
Route::get('/quen-mat-khau', [AuthController::class, 'getQuenMatKhau']);
Route::post('/quen-mat-khau', [AuthController::class, 'postQuenMatKhau']);
Route::get('/dat-lai-mat-khau/{token}', [AuthController::class, 'getDatLaiMatKhau']);
Route::post('/dat-lai-mat-khau', [AuthController::class, 'postDatLaiMatKhau']);

Route::get('/gioi-thieu', [PortfolioController::class, 'index']);
Route::get('/trang-chu', [TinController::class, 'index']);


Route::get('/lien-he', [TinController::class, 'lienhe']);

Route::get('/chi-tiet/{id}', [TinController::class, 'chitiet']);
Route::post('/binh-luan', [TinController::class, 'binhluan']);
Route::get('/cat/{idLT}', [TinController::class, 'tintrongloai']);
Route::get('/txn', function () {
    $query = DB::table('tin')
        ->select('id', 'tieuDe', 'xem')
        ->orderBy('xem', 'desc')
        ->limit(10);

    $data = $query->get();
    return view('txn', ['data' => $data]);
});

Route::get('/tinmoi', function () {
    $query = DB::table('tin')
        ->select('id', 'tieuDe', 'ngayDang')
        ->orderBy('ngayDang', 'desc')
        ->limit(10);

    $data = $query->get();

    return view('tinmoi', ['data' => $data]);
});
// Route::get('/tin/{id}', function ($id) {
//     $tin = DB::table('tin')->where('id', $id)->first();
//     return view('chitiettin', ['tin' => $tin]);
// });

// lab3
Route::get(
    '/user',
    function () {
        $user = DB::table('thanhvien')
            ->select('id', 'hoTen', 'email')
            ->limit(10);
        $user = $user->get();
        foreach ($user as $u) {
            echo $u->hoTen . ' - ' . $u->email . '<br>';
        }
    }

);
Route::get('/sanpham', function () {
    $sanpham = DB::table('dienthoai')
        ->select('id', 'tenDT', 'gia')
        ->limit(200);
    $sanpham = $sanpham->get();
    foreach ($sanpham as $sp) {
        echo $sp->tenDT . ' - ' . $sp->gia . '<br>';
    }
});
