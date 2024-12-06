<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhapKho extends Model
{
    use HasFactory;

    protected $table = "nhap_khos";
    protected $fillable = [
        'id_san_pham',
        'id_dai_ly',
        'so_luong',
        'don_gia',
        'thanh_tien',
        'trang_thai',
        'ghi_chu'
    ];
}
