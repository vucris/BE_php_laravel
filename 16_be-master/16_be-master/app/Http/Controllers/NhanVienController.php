<?php

namespace App\Http\Controllers;

use App\Http\Requests\CapNhapNhanVienRequest;
use App\Http\Requests\ThemMoiNhanVienRequest;
use App\Models\ChucNang;
use App\Models\NhanVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NhanVienController extends Controller
{
    public function getDataChucNang()
    {

        $id_chuc_nang = 37;

        $data = ChucNang::get();

        return response()->json([
            'data' => $data
        ]);
    }
    public function store(ThemMoiNhanVienRequest $request)
    {
        $id_chuc_nang = 19;

        NhanVien::create([
            'email'         => $request->email,
            'password'      => bcrypt($request->password),
            'ho_va_ten'     => $request->ho_va_ten,
            'so_dien_thoai' => $request->so_dien_thoai,
            'dia_chi'       => $request->dia_chi,
            'tinh_trang'    => $request->tinh_trang,
            'id_quyen'      => $request->id_quyen,
        ]);

        return response()->json([
            'status'    => true,
            'message'   => 'Thêm mới nhân viên thành công!'
        ]);
    }

    public function getData()
    {
        $id_chuc_nang = 18;

        $data = NhanVien::get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function update(CapNhapNhanVienRequest $request)
    {
        $id_chuc_nang = 21;

        $nhan_vien = NhanVien::where('id', $request->id)->first();
        if($nhan_vien) {
            $nhan_vien->update([
                'email'             => $request->email,
                'ho_va_ten'         => $request->ho_va_ten,
                'so_dien_thoai'     => $request->so_dien_thoai,
                'dia_chi'           => $request->dia_chi,
                'tinh_trang'        => $request->tinh_trang,
            ]);

            return response()->json([
                'status' => true,
                'message' => "Cập Nhật Nhân viên thành công!"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Có Lỗi"
            ]);
        }
    }

    public function destroy($id)
    {
        $id_chuc_nang = 20;

        $nhan_vien = NhanVien::where('id', $id)->first();

        if($nhan_vien) {
            $nhan_vien->delete();

            return response()->json([
                'status' => true,
                'message' => "Đã xóa Nhân viên thành công!"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Có Lỗi"
            ]);
        }
    }

    public function changeStatus(Request $request)
    {
        $id_chuc_nang = 22;

        $data   = NhanVien::where('id', $request->id)->first();
        if($data) {
            if($data->tinh_trang == 0) {
                $data->tinh_trang = 1;
            } else {
                $data->tinh_trang = 0;
            }
            $data->save();

            return response()->json([
                'status'    =>   true,
                'message'   =>   'Đã đổi trạng thái đại lý ' . $data->ho_va_ten . '!',
            ]);
        } else {
            return response()->json([
                'status'    =>   false,
                'message'   =>   'Không tìm được đại lý để cập nhật!'
            ]);
        }
    }

    public function dangNhap(Request $request)
    {
        $check  = Auth::guard('nhan_vien')->attempt(['email' => $request->email, 'password' => $request->password]);
        if($check) {
            $user   =   Auth::guard('nhan_vien')->user();
            if($user->tinh_trang == 0) {
                return response()->json([
                    'message'  =>   'Tài khoản của bạn đã bị khóa!',
                    'status'   =>   2
                ]);
            } else {
                return response()->json([
                    'message'   =>   'Đã đăng nhập thành công!',
                    'status'    =>   1,
                    'chia_khoa' =>   $user->createToken('ma_so_bi_mat_nhan_vien')->plainTextToken,
                    'ten_admin' =>   $user->ho_va_ten
                ]);
            }
        } else {
            return response()->json([
                'message'  =>   'Tài khoản hoặc mật khẩu không đúng!',
                'status'   =>   false
            ]);
        }
    }

    public function kiemTraChiaKhoa()
    {
        $check  = $this->isUserNhanVien();
        if($check) {
            return response()->json([
                'status'   =>   true,
                'message'  =>   'Ok, bạn có thể đi qua!',
            ]);
        } else {
            return response()->json([
                'status'   =>   false,
                'message'  =>   'Bạn chưa đăng nhập tài khoản nhân viên!',
            ]);
        }
    }

    public function dangXuat()
    {
        $nhan_vien = Auth::guard('sanctum')->user();
        if($nhan_vien){
            DB::table('personal_access_tokens')
              ->where('id', $nhan_vien->currentAccessToken()->id)->delete();

            return response()->json([
                'status' => true,
                'message' => "Đã đăng xuất thiết bị này thành công"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Vui lòng đăng nhập"
            ]);
        }
    }

    public function dangXuatAll()
    {
        $nhan_vien = Auth::guard('sanctum')->user();
        if($nhan_vien){
            $ds_token = $nhan_vien->tokens;
            foreach($ds_token as $k => $v) {
                $v->delete();
            }

            return response()->json([
                'status' => true,
                'message' => "Đã đăng xuất tất cả thiết bị này thành công"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Vui lòng đăng nhập"
            ]);
        }
    }
}
