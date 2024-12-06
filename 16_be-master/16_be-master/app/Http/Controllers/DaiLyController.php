<?php

namespace App\Http\Controllers;

use App\Http\Requests\CapNhapDaiLyRequest;
use App\Http\Requests\LayLaiMatKhauRequest;
use App\Http\Requests\ThemVaoDaiLyRequest;
use App\Mail\KichHoatTaiKhoan;
use App\Mail\KichHoatTaiKhoan_Dai_Ly;
use App\Mail\QuenMatKhau;
use App\Mail\QuenMatKhau_Dai_Ly;
use App\Models\DaiLy;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class DaiLyController extends Controller
{
    public function store(ThemVaoDaiLyRequest $request)
    {
        $id_chuc_nang = 9;

        $dai_ly = DaiLy::create([
            'ho_va_ten'             =>  $request->ho_va_ten,
            'email'                 =>  $request->email,
            'so_dien_thoai'         =>  $request->so_dien_thoai,
            'ngay_sinh'             =>  $request->ngay_sinh,
            'password'              =>  bcrypt($request->password),
            'ten_doanh_nghiep'      =>  $request->ten_doanh_nghiep,
            'ma_so_thue'            =>  $request->ma_so_thue,
            'dia_chi_kinh_doanh'    =>  $request->dia_chi_kinh_doanh,
            'hash_active'           =>  Str::uuid(),
        ]);

        Mail::to($request->email)->send(new KichHoatTaiKhoan_Dai_Ly($dai_ly->hash_active, $dai_ly->ho_va_ten));

        return response()->json([
            'message'  =>   'Đã đăng ký tài khoản thành công!',
            'status'   =>   true
        ]);
    }

    public function getData()
    {
        $id_chuc_nang = 8;

        $duLieu = DaiLy::get();

        return response()->json([
            'data'  =>   $duLieu,
        ]);
    }

    public function changeStatus(Request $request)
    {
        $id_chuc_nang = 12;

        $data   = DaiLy::where('id', $request->id)->first();
        if($data) {
            if($data->is_active == 0) {
                $data->is_active = 1;
            } else {
                $data->is_active = 0;
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

    public function update(CapNhapDaiLyRequest $request)
    {
        $id_chuc_nang = 11;

        $data   = DaiLy::where('id', $request->id)->first();
        if($data) {
            $data->update([
                'ho_va_ten'             => $request->ho_va_ten,
                'email'                 => $request->email,
                'so_dien_thoai'         => $request->so_dien_thoai,
                'ngay_sinh'             => $request->ngay_sinh,
                'ten_doanh_nghiep'      => $request->ten_doanh_nghiep,
                'ma_so_thue'            => $request->ma_so_thue,
                'dia_chi_kinh_doanh'    => $request->dia_chi_kinh_doanh,
                'is_active'             => $request->is_active,
            ]);
            return response()->json([
                'status'    =>   true,
                'message'   =>   'Đã cập nhật đại lý thành công!'
            ]);
        } else {
            return response()->json([
                'status'    =>   false,
                'message'   =>   'Không tìm được đại lý để cập nhật!'
            ]);
        }
    }

    public function destroy($id)
    {
        $id_chuc_nang = 10;

        $data   =   DaiLy::where('id', $id)->first();
        if($data) {
            $data->delete();
            return response()->json([
                'status'    =>   true,
                'message'   =>   'Đã xóa đại lý thành công!'
            ]);
        } else {
            return response()->json([
                'status'    =>   false,
                'message'   =>   'Không tìm được đại lý để xóa!'
            ]);
        }
    }

    public function dangNhap(Request $request)
    {
        // Kiểm tra email + password đúng hay không?
        $check  = Auth::guard('dai_ly')->attempt(['email' => $request->email, 'password' => $request->password]);
        if($check) {
            $user   =   Auth::guard('dai_ly')->user();
            if($user->is_active == 0) {
                return response()->json([
                    'message'  =>   'Tài khoản của bạn chưa được xác nhận!',
                    'status'   =>   2
                ]);
            } else {
                return response()->json([
                    'message'   =>   'Đã đăng nhập thành công!',
                    'status'    =>   1,
                    'chia_khoa' =>   $user->createToken('ma_so_bi_mat')->plainTextToken,
                    'ten_dl'    =>   $user->ho_va_ten
                ]);
            }
        } else {
            return response()->json([
                'message'  =>   'Tài khoản hoặc mật khẩu không đúng!',
                'status'   =>   false
            ]);
        }
    }

    public function kiemTraChiaKhoa(Request $request)
    {
        $check  = $this->isUserDaiLy();
        if($check) {
            return response()->json([
                'status'   =>   true,
                'message'  =>   'Ok, bạn có thể đi qua!',
            ]);
        } else {
            return response()->json([
                'status'   =>   false,
                'message'  =>   'Bạn chưa đăng nhập tài khoản đại lý!',
            ]);
        }
    }
    public function actionQuenMatKhau(Request $request)
    {
        try {
            $quenMK = DaiLy::where('email', $request->email)->first();

            if ($quenMK) {
                $quenMK->hash_reset = Str::uuid();
                $quenMK->save();
                Mail::to($request->email)->send(new QuenMatKhau_Dai_Ly($quenMK->hash_reset, $quenMK->ho_va_ten));
            }
            return response()->json([
                'status' => true,
                'message' => "Kiểm tra email của bạn !!!"
            ]);
        } catch (Exception) {
            return response()->json([
                'status' => false,
                'message' => "Đã có lỗi xảy ra!"
            ]);
        }
    }
    public function actionLaylaiMK($hash_reset, LayLaiMatKhauRequest $request)
    {
        $dai_ly = DaiLy::where('hash_reset', $hash_reset)->first();
        if ($dai_ly) {
            $dai_ly->password = bcrypt($request->password);
            $dai_ly->hash_reset = null;
            $dai_ly->save();
            return response()->json([
                'status' => true,
                'message' => "Mật khẩu đã được thay đổi"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Đã có lỗi xảy ra!"
            ]);
        }
    }
    public function actionKichHoatTK($hash_active)
    {
        $dai_ly = DaiLy::where('hash_active', $hash_active)->where('is_active', 0)->first();

        if($dai_ly) {
            $dai_ly->is_active = 1;
            $dai_ly->hash_active = null;
            $dai_ly->save();

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

    public function dangXuat()
    {
        $dai_ly = Auth::guard('sanctum')->user();
        if($dai_ly){
            DB::table('personal_access_tokens')
              ->where('id', $dai_ly->currentAccessToken()->id)->delete();
            
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
        $dai_ly = Auth::guard('sanctum')->user();
        if($dai_ly){
            $ds_token = $dai_ly->tokens;
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
