<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function isUserNhanVien()
    {
        $user = Auth::guard('sanctum')->user();

        if ($user instanceof \App\Models\NhanVien) {
            return $user;
        }
        return false;
    }
    public function isUserKhachHang()
    {
        $user = Auth::guard('sanctum')->user();

        if ($user instanceof \App\Models\KhachHang) {
            return $user;
        }
        return false;
    }
    public function isUserDaiLy()
    {
        $user = Auth::guard('sanctum')->user();

        if ($user instanceof \App\Models\DaiLy) {
            return $user;
        }
        return false;
    }
}
