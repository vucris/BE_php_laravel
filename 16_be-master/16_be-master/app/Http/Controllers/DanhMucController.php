<?php

namespace App\Http\Controllers;

use App\Http\Requests\CapNhapDanhMucRequest;
use App\Http\Requests\ThemMoiDanhMucRequest;
use App\Models\DanhMuc;
use Illuminate\Http\Request;

class DanhMucController extends Controller
{
    public function getData()
    {
        $id_chuc_nang = 1;

        $dulieu   = DanhMuc::select('id', 'ten_danh_muc', 'slug_danh_muc', 'tinh_trang', 'id_danh_muc_cha')
                         ->get();

        return response()->json([
            'data'  =>  $dulieu
        ]);
    }

    public function store(ThemMoiDanhMucRequest $request)
    {
        $id_chuc_nang = 2;

        DanhMuc::create([
            'ten_danh_muc'      =>  $request->ten_danh_muc,
            'slug_danh_muc'     =>  $request->slug_danh_muc,
            'tinh_trang'        =>  $request->tinh_trang,
            'hinh_anh'          =>  $request->hinh_anh,
            'id_danh_muc_cha'   =>  $request->id_danh_muc_cha,
        ]);

        // Sau khi xong thì BE nên trả về FE thông tin, muốn trả về gì thì do coder
        return response()->json([
            'message'  =>   'Đã tạo mới danh mục thành công!',
            'status'   =>   true
        ]);
    }

    public function checkSlug(Request $request)
    {
        $id_chuc_nang = 3;
        // $request->slug_danh_muc
        $data   =   DanhMuc::where('slug_danh_muc', $request->slug_danh_muc)->first();
        if($data) {
            return response()->json([
                'status'   =>   true
            ]);
        } else {
            return response()->json([
                'status'   =>   false
            ]);
        }
    }

    public function checkSlugUpdate(Request $request)
    {
        $id_chuc_nang = 4;
        // $request->slug_danh_muc
        $data   =   DanhMuc::where('slug_danh_muc', $request->slug_danh_muc)
                           ->where('id', '<>', $request->id)
                           ->first();
        if($data) {
            return response()->json([
                'status'   =>   true
            ]);
        } else {
            return response()->json([
                'status'   =>   false
            ]);
        }
    }

    public function destroy($id)
    {
        $id_chuc_nang = 5;

        $data   =   DanhMuc::where('id', $id)->first();
        if($data) {
            $data->delete();
            return response()->json([
                'status'    =>   true,
                'message'   =>   'Đã xóa danh mục thành công!'
            ]);
        } else {
            return response()->json([
                'status'    =>   false,
                'message'   =>   'Không tìm được danh mục để xóa!'
            ]);
        }
    }

    public function update(CapNhapDanhMucRequest $request)
    {
        $id_chuc_nang = 6;

        $data   = DanhMuc::where('id', $request->id)->first();
        if($data) {
            $data->update([
                'ten_danh_muc'      =>  $request->ten_danh_muc,
                'slug_danh_muc'     =>  $request->slug_danh_muc,
                'tinh_trang'        =>  $request->tinh_trang,
            ]);
            return response()->json([
                'status'    =>   true,
                'message'   =>   'Đã cập nhật danh mục!'
            ]);
        } else {
            return response()->json([
                'status'    =>   false,
                'message'   =>   'Không tìm được danh mục để cập nhật!'
            ]);
        }
    }

    public function changeStatus(Request $request)
    {
        $id_chuc_nang = 7;

        $data   = DanhMuc::where('id', $request->id)->first();
        if($data) {
            if($data->tinh_trang == 0) {
                $data->tinh_trang = 1;
            } else {
                $data->tinh_trang = 0;
            }
            // $data->tinh_trang = $data->tinh_trang == 1 ? 0 : 1;
            // $data->tinh_trang = !$data->tinh_trang;
            $data->save();
            return response()->json([
                'status'    =>   true,
                'message'   =>   'Đã đổi trạng thái danh mục ' . $data->ten_danh_muc . '!',
            ]);
        } else {
            return response()->json([
                'status'    =>   false,
                'message'   =>   'Không tìm được danh mục để cập nhật!'
            ]);
        }
    }

    public function dataDanhMucClient()
    {
        $data = DanhMuc::where('tinh_trang', 1)->get();

        return response()->json([
            'data' => $data
        ]);
    }
}
