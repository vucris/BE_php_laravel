<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class KhachHang extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "khach_hangs";
    protected $fillable = [
        'email',
        'so_dien_thoai',
        'ho_va_ten',
        'password',
        'hash_reset',
        'hash_active',
        'is_active',
        'is_block',
    ];
}
