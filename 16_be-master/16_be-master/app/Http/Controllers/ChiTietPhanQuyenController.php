<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChiTietPhanQuyenRequest;
use App\Models\ChiTietPhanQuyen;
use Illuminate\Http\Request;

class ChiTietPhanQuyenController extends Controller
{
    public function chiTietChucNang($id_quyen)
    {
        $data = ChiTietPhanQuyen::where('id_quyen', $id_quyen)
                                ->join('chuc_nangs', 'chuc_nangs.id', 'chi_tiet_phan_quyens.id_chuc_nang')
                                ->select('chi_tiet_phan_quyens.*', 'chuc_nangs.ten_chuc_nang')
                                ->get();

        return response()->json([
            'data'    => $data,
        ]);
    }

    public function store(ChiTietPhanQuyenRequest $request)
    {

        $id_chuc_nang = 38;

        $check = ChiTietPhanQuyen::where('id_quyen', $request->id_quyen)
                                 ->where('id_chuc_nang', $request->id_chuc_nang)
                                 ->first();

        if($check) {
            return response()->json([
                'status'    => false,
                'message'   => 'Quyền này đã được phân rồi'
            ]);
        }
        ChiTietPhanQuyen::create([
            'id_quyen' => $request->id_quyen,
            'id_chuc_nang' => $request->id_chuc_nang
        ]);

        return response()->json([
            'status'    => true,
            'message'   => 'Đã Phân Quyền thành công!'
        ]);
    }

    public function destroy(Request $request)
    {
        ChiTietPhanQuyen::find($request->id)->delete();

        return response()->json([
            'status'    => true,
            'message'   => 'Đã Xoá Phân Quyền thành công!'
        ]);
    }
}
