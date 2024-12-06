<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SanPhamController extends Controller
{
    public function store(Request $request)
    {
        $user  = Auth::guard('sanctum')->user();

        SanPham::create([
            'ten_san_pham'          => $request->ten_san_pham,
            'slug_san_pham'         => $request->slug_san_pham,
            'hinh_anh'              => $request->hinh_anh,
            'tinh_trang'            => $request->tinh_trang,
            'mo_ta_ngan'            => $request->mo_ta_ngan,
            'mo_ta_chi_tiet'        => $request->mo_ta_chi_tiet,
            'gia_ban'               => $request->gia_ban,
            'gia_khuyen_mai'        => $request->gia_khuyen_mai,
            'id_danh_muc'           => $request->id_danh_muc,
            'id_dai_ly'             => $user->id
            
            
            ,
        ]);

        return response()->json([
            'status'    => true,
            'message'   => "Đã thêm mới sản phảm thành công!"
        ]);
    }

    public function getData()
    {
        $daiLy  = Auth::guard('sanctum')->user();
        $data   = SanPham::where('id_dai_ly', $daiLy->id)->get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function update(Request $request)
    {
        $daiLy   = Auth::guard('sanctum')->user();
        $sanPham = SanPham::where('id', $request->id)->where('id_dai_ly', $daiLy->id)->first();

        if($sanPham) {
            $sanPham->update([
                'ten_san_pham'          => $request->ten_san_pham,
                'slug_san_pham'         => $request->slug_san_pham,
                'hinh_anh'              => $request->hinh_anh,
                'tinh_trang'            => $request->tinh_trang,
                'mo_ta_ngan'            => $request->mo_ta_ngan,
                'mo_ta_chi_tiet'        => $request->mo_ta_chi_tiet,
                'gia_ban'               => $request->gia_ban,
                'gia_khuyen_mai'        => $request->gia_khuyen_mai,
                'id_danh_muc'           => $request->id_danh_muc,
            ]);

            return response()->json([
                'status'    => true,
                'message'   => "Đã cập nhật sản phảm thành công!"
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => "Sản Phẩm không tồn tại!"
            ]);
        }
    }

    public function delete($id)
    {
        $daiLy  = Auth::guard('sanctum')->user();
        $sanPham = SanPham::where('id', $id)->where('id_dai_ly', $daiLy->id)->first();

        if($sanPham) {
            $sanPham->delete();

            return response()->json([
                'status'    => true,
                'message'   => "Đã xóa sản phảm thành công!"
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => "Sản Phẩm không tồn tại!"
            ]);
        }
    }

    public function changeStatus(Request $request)
    {
        $sanPham = SanPham::where('id', $request->id)->first();

        if($sanPham) {
            if($sanPham->tinh_trang == 0) {
                $sanPham->tinh_trang = 1;
            } else {
                $sanPham->tinh_trang = 0;
            }
            $sanPham->save();

            return response()->json([
                'status'    => true,
                'message'   => "Đã cập nhật trạng thái sản phảm thành công!"
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => "Sản Phẩm không tồn tại!"
            ]);
        }
    }

    public function chiTietSanPham(Request $request)
    {
        $sanPham = SanPham::where('id', $request->id)->first();

        if($sanPham) {
            return response()->json([
                'status' => true,
                'data' => $sanPham
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Có lỗi!"
            ]);
        }
    }

    public function sanPhamChiTiet($id)
    {
        $sanPham = SanPham::where('id', $id)->first();

        if($sanPham) {
            return response()->json([
                'status' => true,
                'data' => $sanPham
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Không có sản phẩm!"
            ]);
        }
    }

    public function dataDanhSachSanPhamTheoDanhMuc(Request $request)
    {
        $data = SanPham::where('id_danh_muc', $request->id)->get();
        return response()->json([
            'data' => $data
        ]);
    }

    public function timKiemTrangChu(Request $request)
    {
        $tim_kiem = "%" . $request->thong_tin_tim . "%";

        $data   = SanPham::where('ten_san_pham', "like", $tim_kiem)->get();

        return response()->json([
            'data' => $data
        ]);
    }
}
