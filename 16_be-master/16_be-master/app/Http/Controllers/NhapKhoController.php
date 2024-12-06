<?php

namespace App\Http\Controllers;

use App\Models\NhapKho;
use App\Models\SanPham;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NhapKhoController extends Controller
{
    public function themSanPhamNhapKho(Request $request)
    {
        $dai_ly     = Auth::guard('sanctum')->user();
        $san_pham   = SanPham::where('id', $request->id)->where('id_dai_ly', $dai_ly->id)->first();
        if ($san_pham) {
            NhapKho::create([
                'id_san_pham'   => $request->id,
                'id_dai_ly'     => $dai_ly->id,
            ]);

            return response()->json([
                'status' => true,
                'message' => "Thêm sản phẩm nhập kho thành công!"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Có lỗi"
            ]);
        }
    }

    public function dataSanPhamNhapKho()
    {
        $dai_ly     = Auth::guard('sanctum')->user();
        // SELECT nhap_khos.*, san_phams.ten_san_pham
        // from nhap_khos join san_phams ON nhap_khos.id_san_pham =

        $data       = NhapKho::join('san_phams', 'nhap_khos.id_san_pham', 'san_phams.id')
                             ->where('nhap_khos.id_dai_ly', $dai_ly->id)
                             ->where('nhap_khos.trang_thai', 0)
                             ->select('nhap_khos.*', 'san_phams.ten_san_pham as abcd')
                             ->get();
        $tong_tien = $data->sum('thanh_tien');
        return response()->json([
            'data'      => $data,
            "tong_tien" => $tong_tien
        ]);
    }

    public function capNhatSanPhamNhapKho(Request $request)
    {
        $dai_ly     = Auth::guard('sanctum')->user();
        $san_pham   = SanPham::where('id', $request->id_san_pham)->where('id_dai_ly', $dai_ly->id)->first();
        if($san_pham) {
            $data = NhapKho::where('id', $request->id)->first();
            if($data) {
                $data->update([
                    'so_luong' => $request->so_luong,
                    'don_gia' => $request->don_gia,
                    'ghi_chu' => $request->ghi_chu,
                    'thanh_tien' => $request->so_luong * $request->don_gia,
                ]);

                return response()->json([
                    'status' => true,
                    'message' => "Cập nhật sản phẩm nhập kho thành công!"
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "Có lỗi"
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => "Bạn không thuộc sở hữu sản phẩm này!"
            ]);
        }
    }

    public function xoaSanPhamNhapKho(Request $request)
    {
        $dai_ly     = Auth::guard('sanctum')->user();
        $san_pham   = SanPham::where('id', $request->id_san_pham)->where('id_dai_ly', $dai_ly->id)->first();
        if($san_pham) {
            try {
                NhapKho::where('id', $request->id)->delete();
                return response()->json([
                    'status' => true,
                    'message' => "Xóa sản phẩm nhập kho thành công!"
                ]);
            } catch (Exception) {
                return response()->json([
                    'status' => false,
                    'message' => "Có Lỗi!"
                ]);
            }

        } else {
            return response()->json([
                'status' => false,
                'message' => "Bạn không thuộc sở hữu sản phẩm này!"
            ]);
        }
    }

    public function xacNhanNhapKho(Request $request)
    {
        $dai_ly     = Auth::guard('sanctum')->user();
        try {
            NhapKho::where('id_dai_ly', $dai_ly->id)
                    ->where('trang_thai', 0)
                    ->update([
                        'trang_thai' => 1
                    ]);

            return response()->json([
                'status' => true,
                'message' => "Nhập kho thành công!"
            ]);
        } catch (Exception) {
            return response()->json([
                'status' => false,
                'message' => "Có Lỗi!"
            ]);
        }
    }

    public function danhSachNhapKho()
    {
        $dai_ly     = Auth::guard('sanctum')->user();
        $data       = NhapKho::join('san_phams', 'nhap_khos.id_san_pham', 'san_phams.id')
                             ->where('nhap_khos.id_dai_ly', $dai_ly->id)
                             ->where('nhap_khos.trang_thai', 1)
                             ->orderByDESC('nhap_khos.updated_at')
                             ->select('nhap_khos.*', 'san_phams.ten_san_pham as abcd')
                             ->get();
        return response()->json([
            'data'  => $data,
        ]);
    }

    public function thongKeKho()
    {
        $dai_ly     = Auth::guard('sanctum')->user();
        $data       = NhapKho::join('san_phams', 'nhap_khos.id_san_pham', 'san_phams.id')
                             ->select('nhap_khos.id_san_pham', 'san_phams.ten_san_pham', DB::raw('SUM(nhap_khos.so_luong) as tong_nhap'))
                             ->groupBy('nhap_khos.id_san_pham', 'san_phams.ten_san_pham')
                             ->where('nhap_khos.trang_thai', 1)
                             ->where('nhap_khos.id_dai_ly', $dai_ly->id)
                             ->get();

        return response()->json([
            'data'  => $data,
        ]);
    }

}
