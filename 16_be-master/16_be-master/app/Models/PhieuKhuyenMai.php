<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhieuKhuyenMai extends Model
{
    use HasFactory;

    protected $table = 'phieu_khuyen_mais';

    protected $fillable = [
        'ma_khuyen_mai',
        'so_tien_giam',
        'phan_tram_giam',
        'ngay_bat_dau',
        'ngay_ket_thuc',
        'tinh_trang',
    ];
}
