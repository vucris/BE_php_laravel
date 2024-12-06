<?php

namespace App\Http\Controllers;

use App\Models\DanhMuc;
use App\Models\KhachHang;
use App\Models\SanPham;
use Illuminate\Http\Request;

class TrangChuController extends Controller
{
    public function dataTrangChu()
    {
        $listFlashSale              = SanPham::orderByDESC('gia_khuyen_mai')
                                            ->take(3)
                                            ->get();
        $listSanPhamBanChay         = SanPham::orderByDESC('gia_ban')
                                            ->take(10)
                                            ->get();

        $listSanPhamMoi             = SanPham::orderByDESC('id')
                                            ->take(10)
                                            ->get();

        $listSanPhamSoLuongNhieu    = SanPham::orderByDESC('so_luong')
                                            ->take(10)
                                            ->get();

        return response()->json([
            'listFlashSale'             => $listFlashSale,
            'listSanPhamBanChay'        => $listSanPhamBanChay,
            'listSanPhamMoi'            => $listSanPhamMoi,
            'listSanPhamSoLuongNhieu'   => $listSanPhamSoLuongNhieu,
        ]);

    }

    public function dataDanhSachSanPham($id)
    {
        $data = SanPham::where('id_danh_muc', $id)
                       ->where('tinh_trang', 1)
                       ->get();
        $danh_muc = DanhMuc::where('id', $id)->first();
        return response()->json([
            'data'      => $data,
            'danh_muc'  => $danh_muc
        ]);
    }

    public function kichHoatTaiKhoan($hash_active)
    {
        $tai_khoan = KhachHang::where('hash_active', $hash_active)->where('is_active', 0)->first();

        if($tai_khoan) {
            $tai_khoan->is_active = 1;
            $tai_khoan->hash_active = null;
            $tai_khoan->save();

            return response()->json([
                'status' => true,
                'message' => "Bạn đã kích hoạt tài khoản thành công!"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Tài khoản bạn đã được kích hoạt hoặc không tồn tại!"
            ]);
        }
    }
}
