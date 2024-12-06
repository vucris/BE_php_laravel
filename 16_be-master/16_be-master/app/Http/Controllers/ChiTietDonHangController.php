<?php

namespace App\Http\Controllers;

use App\Models\ChiTietDonHang;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChiTietDonHangController extends Controller
{
    public function themVaoGioHang(Request $request)
    {
        $khach_hang = Auth::guard('sanctum')->user();

        $san_pham = SanPham::where('id', $request->id_san_pham)->first();
        if($san_pham) {
            if($san_pham->gia_khuyen_mai > 0) {
                $don_gia = $san_pham->gia_khuyen_mai;
            } else {
                $don_gia = $san_pham->gia_ban;
            }

            $tim    = ChiTietDonHang::where('id_khach_hang', $khach_hang->id)
                                    ->where('id_san_pham', $san_pham->id)
                                    ->whereNull('id_hoa_don') // ->where('id_hoa_don', NULL)
                                    ->first();
            if($tim) {
                $tim->so_luong   = $tim->so_luong + 1;
                $tim->thanh_tien = $tim->so_luong * $don_gia;
                $tim->save();

            } else {
                ChiTietDonHang::create([
                    'id_khach_hang'     => $khach_hang->id,
                    'id_san_pham'       => $san_pham->id,
                    'don_gia'           => $don_gia,
                    'thanh_tien'        => $don_gia * 1,
                ]);
            }

            return response()->json([
                'status' => true,
                'message'=> "Sản phẩm đã được thêm vào giỏ hàng thành công!"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Có lỗi xảy ra!"
            ]);
        }
    }

    public function dataGioHang()
    {
        $khach_hang = Auth::guard('sanctum')->user();

        $data = ChiTietDonHang::where('id_khach_hang', $khach_hang->id)
                              ->join('san_phams', 'san_phams.id', 'chi_tiet_don_hangs.id_san_pham')
                              ->join('dai_lys', 'dai_lys.id', 'san_phams.id_dai_ly')
                              ->select('san_phams.hinh_anh', 'san_phams.ten_san_pham', 'chi_tiet_don_hangs.*', 'dai_lys.ho_va_ten')
                              ->orderBy('dai_lys.ho_va_ten')
                              ->whereNull('id_hoa_don')
                              ->get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function xoaGioHang(Request $request)
    {
        $khach_hang = Auth::guard('sanctum')->user();
        $gio_hang = ChiTietDonHang::where('id', $request->id)->where('id_khach_hang', $khach_hang->id)->first();

        if($gio_hang) {
            $gio_hang->delete();
            return response()->json([
                'status' => true,
                'message'=> "Sản phẩm đã được xóa khỏi vào giỏ hàng thành công!"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Có lỗi xảy ra!"
            ]);
        }
    }

    public function updateGioHang(Request $request)
    {
        $khach_hang = Auth::guard('sanctum')->user();

        $gio_hang = ChiTietDonHang::where('id', $request->id)->where('id_khach_hang', $khach_hang->id)->first();

        if($gio_hang) {
            $gio_hang->so_luong     = $request->so_luong;
            $gio_hang->thanh_tien   = $request->so_luong * $gio_hang->don_gia;
            $gio_hang->ghi_chu      = $request->ghi_chu;
            $gio_hang->save();

            return response()->json([
                'status' => true,
                'message'=> "Đã cập nhật giỏ hàng thành công!"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Có lỗi xảy ra!"
            ]);
        }
    }
}
