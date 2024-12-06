<?php

namespace App\Http\Controllers;

use App\Http\Requests\ThemMoiPhieuKhuyenMaiRequest;
use App\Models\PhieuKhuyenMai;
use Illuminate\Http\Request;

class PhieuKhuyenMaiController extends Controller
{
    public function store(ThemMoiPhieuKhuyenMaiRequest $request)
    {
        $id_chuc_nang = 14;

        PhieuKhuyenMai::create([
            'ma_khuyen_mai'   =>  $request->ma_khuyen_mai,
            'so_tien_giam'    =>  $request->so_tien_giam,
            'phan_tram_giam'  =>  $request->phan_tram_giam,
            'ngay_bat_dau'    =>  $request->ngay_bat_dau,
            'ngay_ket_thuc'   =>  $request->ngay_ket_thuc,
            'tinh_trang'      =>  $request->tinh_trang,
        ]);

        return response()->json([
            'message'  =>   'Đã thêm mới phiếu khuyến mãi thành công!',
            'status'   =>   true
        ]);
    }

    public function getData()
    {
        $id_chuc_nang = 13;

        $duLieu = PhieuKhuyenMai::get();

        return response()->json([
            'data'  =>   $duLieu,
        ]);
    }

    public function changeStatus(Request $request)
    {
        $id_chuc_nang = 17;

        $data   = PhieuKhuyenMai::where('id', $request->id)->first();
        if($data) {
            if($data->tinh_trang == 0) {
                $data->tinh_trang = 1;
            } else {
                $data->tinh_trang = 0;
            }

            $data->save();
            return response()->json([
                'status'    =>   true,
                'message'   =>   'Đã đổi trạng thái phiếu khuyến mãi ' . $data->ma_khuyen_mai . '!',
            ]);
        } else {
            return response()->json([
                'status'    =>   false,
                'message'   =>   'Không tìm được phiếu khuyến mãi để cập nhật!'
            ]);
        }
    }

    public function update(ThemMoiPhieuKhuyenMaiRequest $request)
    {
        $id_chuc_nang = 16;

        $data   = PhieuKhuyenMai::where('id', $request->id)->first();
        if($data) {
            $data->update([
                'ma_khuyen_mai'   =>  $request->ma_khuyen_mai,
                'so_tien_giam'    =>  $request->so_tien_giam,
                'phan_tram_giam'  =>  $request->phan_tram_giam,
                'ngay_bat_dau'    =>  $request->ngay_bat_dau,
                'ngay_ket_thuc'   =>  $request->ngay_ket_thuc,
                'tinh_trang'      =>  $request->tinh_trang,
            ]);
            return response()->json([
                'status'    =>   true,
                'message'   =>   'Đã cập nhật phiếu khuyến mãi thành công!'
            ]);
        } else {
            return response()->json([
                'status'    =>   false,
                'message'   =>   'Không tìm được phiếu khuyến mãi để cập nhật!'
            ]);
        }
    }

    public function destroy($id)
    {
        $id_chuc_nang = 15;

        $data   =   PhieuKhuyenMai::where('id', $id)->first();
        if($data) {
            $data->delete();
            return response()->json([
                'status'    =>   true,
                'message'   =>   'Đã xóa phiếu khuyến mãi thành công!'
            ]);
        } else {
            return response()->json([
                'status'    =>   false,
                'message'   =>   'Không tìm được phiếu khuyến mãi để xóa!'
            ]);
        }
    }
}
