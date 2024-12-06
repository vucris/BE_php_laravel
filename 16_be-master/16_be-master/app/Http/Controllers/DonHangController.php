<?php

namespace App\Http\Controllers;

use App\Mail\XacNhanDonHangMail;
use App\Models\ChiTietDonHang;
use App\Models\DiaChi;
use App\Models\DonHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DonHangController extends Controller
{
    public function actionMuaHang(Request $request)
    {
        $khach_hang = Auth::guard('sanctum')->user();
        $dia_chi = DiaChi::where('id', $request->id_dia_chi)->where('id_khach_hang', $khach_hang->id)->first();

        if (!$dia_chi) {
            return response()->json([
                'status' => false,
                'message' => "Bạn chưa chọn địa chỉ mà"
            ]);
        } else if (count($request->ds_mua_sp) < 1) {
            return response()->json([
                'status' => false,
                'message' => "Bạn dã chọn sản phẩm nào đâu mà mua"
            ]);
        } else {
            $don_hang = DonHang::create([
                'ma_don_hang'               => "Lát nữa tính sau",
                'tong_tien_thanh_toan'      => 0,
                'is_thanh_toan'             => 0,   //Khong cần viết dòng nãy cũng được
                'tinh_trang_don_hang'       => 0,   //Khong cần viết dòng nãy cũng được
                'ten_nguoi_nhan'            => $dia_chi->ten_nguoi_nhan,
                'so_dien_thoai'             => $dia_chi->so_dien_thoai,
                'dia_chi_giao_hang'         => $dia_chi->dia_chi,
                'is_giao_kho'               => 0,   //Khong cần viết dòng nãy cũng được
                'id_khach_hang'             => $khach_hang->id
            ]);

            $ma_don_hang = "HDBH" . (101086 + $don_hang->id);
            $tong_tien_thanh_toan = 0;
            foreach ($request->ds_mua_sp as $key => $value) {
                $tong_tien_thanh_toan += $value['thanh_tien'];
                ChiTietDonHang::where('id', $value['id'])->update([
                    'id_hoa_don'    => $don_hang->id,
                ]);
            };

            $don_hang->ma_don_hang = $ma_don_hang;
            $don_hang->tong_tien_thanh_toan = $tong_tien_thanh_toan;
            $don_hang->save();

            $link   =   "https://img.vietqr.io/image/MB-1910061030119-qr_only.png?amount=". $tong_tien_thanh_toan ."&addInfo=" . $ma_don_hang;

            // Gửi Email
            $bien_1['ten_nguoi_nhan']           =   $dia_chi->ten_nguoi_nhan;
            $bien_1['so_dien_thoai_nhan']       =   $dia_chi->so_dien_thoai;
            $bien_1['dia_chi_nhan_hang']        =   $dia_chi->dia_chi;
            $bien_1['tong_tien_thanh_toan']     =   $tong_tien_thanh_toan;
            $bien_1['link_qr_code']             =   $link;
            $bien_2                             =   $request->ds_mua_sp;

            Mail::to($khach_hang->email)->send(new XacNhanDonHangMail($bien_1, $bien_2));

            return response()->json([
                'status' => true,
                'message' => "Đặt đơn hàng thành công"
            ]);
        }
    }

    public function dataDonHang()
    {
        $khach_hang = Auth::guard('sanctum')->user();

        $data = DonHang::where('id_khach_hang', $khach_hang->id)->get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function dataDonHangDaiLy()
    {
        $dai_ly = Auth::guard('sanctum')->user();

        $data = ChiTietDonHang::join('san_phams', 'san_phams.id', 'chi_tiet_don_hangs.id_san_pham')
                              ->join('don_hangs', 'don_hangs.id', 'chi_tiet_don_hangs.id_hoa_don')
                              ->where('san_phams.id_dai_ly', $dai_ly->id)
                              ->select(
                                    'don_hangs.*',
                                    'chi_tiet_don_hangs.id as id_chi_tiet',
                                    'chi_tiet_don_hangs.is_giao_kho',
                                    'san_phams.ten_san_pham',
                                    'chi_tiet_don_hangs.so_luong',
                                    'chi_tiet_don_hangs.don_gia',
                                    'chi_tiet_don_hangs.thanh_tien',
                                )
                              ->get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function xacNhanGiaoKho(Request $request)
    {
        $dai_ly = Auth::guard('sanctum')->user();
        $chi_tiet_don_hang = ChiTietDonHang::where('chi_tiet_don_hangs.id', $request->id_chi_tiet)
                                           ->join('san_phams', 'san_phams.id', 'chi_tiet_don_hangs.id_san_pham')
                                           ->where('san_phams.id_dai_ly', $dai_ly->id)
                                           ->select('chi_tiet_don_hangs.*')
                                           ->first();

        if($chi_tiet_don_hang) {
            $chi_tiet_don_hang->is_giao_kho = 1;
            $chi_tiet_don_hang->save();

            return response()->json([
                'status' => true,
                'message' => "Đã giao kho thành công"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Đã có lỗi xảy ra!"
            ]);
        }
    }

    public function adminDataDonHang()
    {

        $id_chuc_nang = 33;

        $data = DonHang::get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function adminDataChiTietDonHang(Request $request)
    {

        $id_chuc_nang = 34;

        $data = ChiTietDonHang::join('san_phams', 'san_phams.id', 'chi_tiet_don_hangs.id_san_pham')
                              ->join('dai_lys', 'dai_lys.id', 'san_phams.id_dai_ly')
                              ->where('chi_tiet_don_hangs.id_hoa_don', $request->id)
                              ->select('dai_lys.ho_va_ten', 'san_phams.ten_san_pham', 'chi_tiet_don_hangs.*')
                              ->get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function adminChangeThanhToan(Request $request)
    {

        $id_chuc_nang = 35;

        $data = DonHang::where('id', $request->id)->first();
        if($data){
            if($request->is_thanh_toan == 0){
                $data->is_thanh_toan = 1;
                $data->save();
                return response()->json([
                    'status' => true,
                    'message' => "Đã cập nhật trạng thái thành công"
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => "Đơn hàng không tồn tại"
            ]);
        }
    }

    public function adminChangeDonHang(Request $request)
    {

        $id_chuc_nang = 36;

        $data = DonHang::where('id', $request->id)->first();
        if($data){
            if($request->tinh_trang_don_hang == 0){
                $data->tinh_trang_don_hang = 1;
                $data->save();
                return response()->json([
                    'status' => true,
                    'message' => "Đã cập nhật tình trạng đơn hàng thành công"
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => "Đơn hàng không tồn tại"
            ]);
        }
    }


}
