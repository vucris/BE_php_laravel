<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class NhanVien extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "nhan_viens";
    protected $fillable = [
        'email',
        'password',
        'ho_va_ten',
        'so_dien_thoai',
        'dia_chi',
        'tinh_trang',
        'is_master',
        'id_quyen',
    ];
}
