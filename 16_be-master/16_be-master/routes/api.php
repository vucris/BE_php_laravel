<?php

use App\Http\Controllers\ChiTietDonHangConTroller;
use App\Http\Controllers\ChiTietPhanQuyenController;
use App\Http\Controllers\DaiLyController;
use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\DiaChiController;
use App\Http\Controllers\DonHangController;
use App\Http\Controllers\GiaoDichController;
use App\Http\Controllers\KhachhangController;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\NhapKhoController;
use App\Http\Controllers\PhanQuyenController;
use App\Http\Controllers\PhieuKhuyenMaiController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\ThongKeController;
use App\Http\Controllers\TrangChuController;
use App\Models\PhieuKhuyenMai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/xem-giao-dich', [GiaoDichController::class, 'index']);


Route::group(['prefix'  =>  '/admin'], function() {

    Route::get('/danh-muc/data', [DanhMucController::class, 'getData']);
    //127.0.0.1:8000/api/danh-muc/data
    Route::post('/danh-muc/create', [DanhMucController::class, 'store']);
    //127.0.0.1:8000/api/danh-muc/create
    Route::post('/danh-muc/check-slug', [DanhMucController::class, 'checkSlug']);
    Route::post('/danh-muc/check-slug-update', [DanhMucController::class, 'checkSlugUpdate']);
    //delete
    Route::delete('/danh-muc/delete/{id}', [DanhMucController::class, 'destroy']);
    //http://127.0.0.1:8000/api/danh-muc/delete/{id}
    Route::put('/danh-muc/update', [DanhMucController::class, 'update']);
    Route::put('/danh-muc/change-status', [DanhMucController::class, 'changeStatus']);

    Route::get('/dai-ly/data', [DaiLyController::class, 'getData']);
    Route::post('/dai-ly/create', [DaiLyController::class, 'store']);
    Route::delete('/dai-ly/delete/{id}', [DaiLyController::class, 'destroy']);
    Route::put('/dai-ly/update', [DaiLyController::class, 'update']);
    Route::put('/dai-ly/change-status', [DaiLyController::class, 'changeStatus']);

    Route::get('/phieu-khuyen-mai/data', [PhieuKhuyenMaiController::class, 'getData']);
    Route::post('/phieu-khuyen-mai/create', [PhieuKhuyenMaiController::class, 'store']);
    Route::delete('/phieu-khuyen-mai/delete/{id}', [PhieuKhuyenMaiController::class, 'destroy']);
    Route::put('/phieu-khuyen-mai/update', [PhieuKhuyenMaiController::class, 'update']);
    Route::put('/phieu-khuyen-mai/change-status', [PhieuKhuyenMaiController::class, 'changeStatus']);

    Route::post('/nhan-vien/create', [NhanVienController::class, 'store']);
    Route::get('/nhan-vien/data', [NhanVienController::class, 'getData']);
    Route::put('/nhan-vien/update', [NhanVienController::class, 'update']);
    Route::delete('/nhan-vien/delete/{id}', [NhanVienController::class, 'destroy']);
    Route::put('/nhan-vien/change-status', [NhanVienController::class, 'changeStatus']);

    Route::get('/dang-xuat', [NhanVienController::class, 'dangXuat']);
    Route::get('/dang-xuat-all', [NhanVienController::class, 'dangXuatAll']);

    Route::get('/phan-quyen/data', [PhanQuyenController::class, 'getData']);
    Route::post('/phan-quyen/create', [PhanQuyenController::class, 'createData']);
    Route::put('/phan-quyen/update', [PhanQuyenController::class, 'UpateData']);
    Route::delete('/phan-quyen/delete/{id}', [PhanQuyenController::class, 'deleteData']);

    Route::get('/khach-hang/data', [KhachhangController::class, 'dataKhachHang']);
    Route::post('/khach-hang/kich-hoat-tai-khoan', [KhachhangController::class, 'kichHoatTaiKhoan']);
    Route::post('/khach-hang/doi-trang-thai', [KhachhangController::class, 'doiTrangThaiKhachHang']);
    Route::post('/khach-hang/update', [KhachhangController::class, 'updateTaiKhoan']);
    Route::post('/khach-hang/delete', [KhachhangController::class, 'deleteTaiKhoan']);
    Route::post('/khach-hang/doi-mat-khau', [KhachhangController::class, 'doiMatKhauTaiKhoan']);

    Route::get('/don-hang/data', [DonHangController::class, 'adminDataDonHang']);
    Route::post('/don-hang/chi-tiet-don-hang', [DonHangController::class, 'adminDataChiTietDonHang']);
    Route::post('/don-hang/doi-trang-thai-thanh-toan', [DonHangController::class, 'adminChangeThanhToan']);
    Route::post('/don-hang/doi-tinh-trang-don-hang', [DonHangController::class, 'adminChangeDonHang']);

    Route::get('/chuc-nang/data', [NhanVienController::class, 'getDataChucNang']);
    Route::get('/chuc-nang-theo-quyen/{id_quyen}', [ChiTietPhanQuyenController::class, 'chiTietChucNang']);
    Route::post('/chi-tiet-phan-quyen/create', [ChiTietPhanQuyenController::class, 'store']);
    Route::post('/chi-tiet-phan-quyen/delete', [ChiTietPhanQuyenController::class, 'destroy']);

});

Route::group(['prefix'  =>  '/dai-ly'], function() {

    Route::post('/san-pham/create', [SanPhamController::class, 'store']);
    Route::get('/san-pham/data', [SanPhamController::class, 'getData']);
    Route::put('/san-pham/update', [SanPhamController::class, 'update']);
    Route::delete('/san-pham/delete/{id}', [SanPhamController::class, 'delete']);
    Route::put('/san-pham/change-status', [SanPhamController::class, 'changeStatus']);

    Route::post('/nhap-kho/them-san-pham-nhap-kho', [NhapKhoController::class, 'themSanPhamNhapKho']);
    Route::get('/nhap-kho/data-san-pham-nhap-kho', [NhapKhoController::class, 'dataSanPhamNhapKho']);
    Route::post('/nhap-kho/cap-nhat-san-pham-nhap-kho', [NhapKhoController::class, 'capNhatSanPhamNhapKho']);
    Route::post('/nhap-kho/xoa-san-pham-nhap-kho', [NhapKhoController::class, 'xoaSanPhamNhapKho']);
    Route::post('/nhap-kho/xac-nhan-nhap-kho', [NhapKhoController::class, 'xacNhanNhapKho']);
    Route::get('/nhap-kho/danh-sach-nhap-kho', [NhapKhoController::class, 'danhSachNhapKho']);
    Route::get('/nhap-kho/thong-ke-kho', [NhapKhoController::class, 'thongKeKho']);
    Route::get('/thong-ke/data-thong-ke-1', [ThongKeController::class, 'dataThongKe1']);
    Route::get('/thong-ke/data-thong-ke-2', [ThongKeConTroller::class, 'dataThongKe2']);

    Route::get('/data-don-hang', [DonHangController::class, 'dataDonHangDaiLy']);
    Route::post('/xac-nhan-giao-kho', [DonHangController::class, 'xacNhanGiaoKho']);
    Route::get('/dang-xuat', [DaiLyController::class, 'dangXuat']);
    Route::get('/dang-xuat-all', [DaiLyController::class, 'dangXuatAll']);

});

Route::group(['prefix'  =>  '/khach-hang'], function() {

    Route::get('/thong-tin', [KhachhangController::class, 'thongTin']);
    Route::post('/update-thong-tin', [KhachhangController::class, 'updateThongTin']);
    Route::post('/update-mat-khau', [KhachhangController::class, 'updateMatKhau']);

    Route::get('/dia-chi/data', [DiaChiController::class, 'data']);
    Route::post('/dia-chi/create', [DiaChiController::class, 'store']);
    Route::post('/dia-chi/update', [DiaChiController::class, 'update']);
    Route::post('/dia-chi/delete', [DiaChiController::class, 'destroy']);

    Route::post('/them-vao-gio-hang', [ChiTietDonHangConTroller::class, 'themVaoGioHang']);
    Route::get('/data-gio-hang', [ChiTietDonHangConTroller::class, 'dataGioHang']);
    Route::post('/xoa-gio-hang', [ChiTietDonHangConTroller::class, 'xoaGioHang']);
    Route::post('/update-gio-hang', [ChiTietDonHangConTroller::class, 'updateGioHang']);

    Route::post('/mua-hang', [DonHangController::class, 'actionMuaHang']);
    Route::get('/data-don-hang', [DonHangController::class, 'dataDonHang']);
    Route::get('/dang-xuat', [KhachhangController::class, 'dangXuat']);
    Route::get('/dang-xuat-all', [KhachhangController::class, 'dangXuatAll']);
});

Route::post('/admin/dang-nhap', [NhanVienController::class, 'dangNhap']);
Route::post('/admin/kiem-tra-chia-khoa', [NhanVienController::class, 'kiemTraChiaKhoa']);

Route::post('/dai-ly/tao-tai-khoan', [DaiLyController::class, 'store']);
Route::post('/dai-ly/dang-nhap', [DaiLyController::class, 'dangNhap']);
Route::post('/dai-ly/kiem-tra-chia-khoa', [DaiLyController::class, 'kiemTraChiaKhoa']);
Route::post('/dai-ly/quen-mat-khau', [DaiLyController::class, 'actionQuenMatKhau']);
Route::post('/dai-ly/lay-lai-mat-khau/{hash_reset}', [DaiLyController::class, 'actionLaylaiMK']);
Route::get('/dai-ly/kich-hoat-tai-khoan/{hash_active}', [DaiLyController::class, 'actionKichHoatTK']);

Route::post('/chi-tiet-san-pham', [SanPhamController::class, 'chiTietSanPham']);
Route::post('/danh-sach-san-pham', [SanPhamController::class, 'dataDanhSachSanPhamTheoDanhMuc']);
Route::get('/danh-muc/data', [DanhMucController::class, 'dataDanhMucClient']);
Route::get('/san-pham/{id}', [SanPhamController::class, 'sanPhamChiTiet']);

Route::get('/trang-chu/data', [TrangChuController::class, 'dataTrangChu']);
Route::post('/trang-chu/tim-kiem', [SanPhamController::class, 'timKiemTrangChu']);
Route::get('/trang-chu/danh-sach-san-pham/{id}', [TrangChuController::class, 'dataDanhSachSanPham']);
Route::get('/kich-hoat-tai-khoan/{id}', [TrangChuController::class, 'kichHoatTaiKhoan']);

Route::post('/khach-hang/create', [KhachhangController::class, 'store']);
Route::post('/khach-hang/login', [KhachhangController::class, 'actionLogin']);
Route::post('/khach-hang/quen-mat-khau', [KhachhangController::class, 'actionQuenmatKhau']);
Route::post('/khach-hang/lay-lai-mat-khau/{hash_reset}', [KhachhangController::class, 'actionLayLaiMatKhau']);
Route::post('/khach-hang/check-login', [KhachhangController::class, 'checkLogin']);







