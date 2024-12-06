<?php

namespace App\Http\Controllers;

use App\Models\NhapKho;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ThongKeController extends Controller
{
    public function dataThongKe1()
    {
        $data = NhapKho::where('trang_thai', 1)
                       ->join('san_phams', 'san_phams.id', 'nhap_khos.id_san_pham')
                       ->select(
                            DB::raw("SUM(nhap_khos.so_luong) as so_luong_san_pham"),
                            'san_phams.ten_san_pham'
                       )
                       ->groupBy('san_phams.ten_san_pham')
                       ->get();
        $array_ten      = [];
        $array_so_lieu  = [];
        foreach ($data as $key => $value) {
            array_push($array_so_lieu, $value->so_luong_san_pham);
            array_push($array_ten, $value->ten_san_pham);
        }


        return response()->json([
            'array_ten'     => $array_ten,
            'array_so_lieu' => $array_so_lieu
        ]);
    }

    public function dataThongKe2()
    {
        $data = NhapKho::where('trang_thai', 1)
                       ->join('san_phams', 'san_phams.id', 'nhap_khos.id_san_pham')
                       ->select(
                            DB::raw("SUM(nhap_khos.thanh_tien) as tong_tien"),
                            'san_phams.ten_san_pham'
                       )
                       ->groupBy('san_phams.ten_san_pham')
                       ->get();
        $array_ten      = [];
        $array_so_lieu  = [];
        foreach ($data as $key => $value) {
            array_push($array_so_lieu, $value->tong_tien);
            array_push($array_ten, $value->ten_san_pham);
        }


        return response()->json([
            'array_ten'     => $array_ten,
            'array_so_lieu' => $array_so_lieu
        ]);
    }



}
