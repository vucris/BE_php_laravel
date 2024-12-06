<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChucNangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('chuc_nangs')->delete();

        DB::table('chuc_nangs')->truncate();

        DB::table('chuc_nangs')->insert([
            ['id' => '1', 'ten_chuc_nang' => 'Lấy Danh Sách Các Danh Mục'],
            ['id' => '2', 'ten_chuc_nang' => 'Tạo Mới Danh Mục'],
            ['id' => '3', 'ten_chuc_nang' => 'Kiểm Tra Slug Danh Mục Lúc Tạo Mới'],
            ['id' => '4', 'ten_chuc_nang' => 'Kiểm Tra Slug Danh Mục Lúc Cập Nhật'],
            ['id' => '5', 'ten_chuc_nang' => 'Xóa Danh Mục'],
            ['id' => '6', 'ten_chuc_nang' => 'Cập Nhật Danh Mục'],
            ['id' => '7', 'ten_chuc_nang' => 'Đổi Trạng Thái Danh Mục'],
            ['id' => '8', 'ten_chuc_nang' => 'Lấy Danh Sách Các Đại Lý'],
            ['id' => '9', 'ten_chuc_nang' => 'Tạo Mới Đại Lý'],
            ['id' => '10', 'ten_chuc_nang' => 'Xóa Đại Lý'],
            ['id' => '11', 'ten_chuc_nang' => 'Cập Nhật Đại Lý'],
            ['id' => '12', 'ten_chuc_nang' => 'Đổi Trạng Thái Đại Lý'],
            ['id' => '13', 'ten_chuc_nang' => 'Lấy Danh Sách Phiếu Khuyến Mãi'],
            ['id' => '14', 'ten_chuc_nang' => 'Tạo Mới Phiếu Khuyến Mãi'],
            ['id' => '15', 'ten_chuc_nang' => 'Xóa Phiếu Khuyến Mãi'],
            ['id' => '16', 'ten_chuc_nang' => 'Cập Nhật Phiếu Khuyến Mãi'],
            ['id' => '17', 'ten_chuc_nang' => 'Đối Trạng Thái Phiếu Khuyến Mãi'],
            ['id' => '18', 'ten_chuc_nang' => 'Lấy Danh Sách Nhân Viên'],
            ['id' => '19', 'ten_chuc_nang' => 'Tạo Mới Nhân Viên'],
            ['id' => '20', 'ten_chuc_nang' => 'Xóa Nhân Viên'],
            ['id' => '21', 'ten_chuc_nang' => 'Cập Nhật Nhân Viên'],
            ['id' => '22', 'ten_chuc_nang' => 'Đổi Trạng Thái Nhân Viên'],
            ['id' => '23', 'ten_chuc_nang' => 'Lấy Danh Sách Khách Hàng'],
            ['id' => '24', 'ten_chuc_nang' => 'Kích Hoạt Tài Khoản Khách Hàng'],
            ['id' => '25', 'ten_chuc_nang' => 'Đổi Trạng Thái Tài Khoản Khách Hàng'],
            ['id' => '26', 'ten_chuc_nang' => 'Cập Nhật Tài Khoản Khách Hàng'],
            ['id' => '27', 'ten_chuc_nang' => 'Xóa Tài Khoản Khách Hàng'],
            ['id' => '28', 'ten_chuc_nang' => 'Đổi Mật Khẩu Tài Khoản Khách Hàng'],
            ['id' => '29', 'ten_chuc_nang' => 'Lấy Danh Sách Phân Quyền'],
            ['id' => '30', 'ten_chuc_nang' => 'Tạo Mới Phân Quyền'],
            ['id' => '31', 'ten_chuc_nang' => 'Cập Nhật Phân Quyền'],
            ['id' => '32', 'ten_chuc_nang' => 'Xóa Phân Quyền'],
            ['id' => '33', 'ten_chuc_nang' => 'Lấy Danh Sách Đơn Hàng'],
            ['id' => '34', 'ten_chuc_nang' => 'Lấy Danh Sách Chi Tiết Đơn Hàng'],
            ['id' => '35', 'ten_chuc_nang' => 'Đổi Trạng Thái Thanh Toán Đơn Hàng'],
            ['id' => '36', 'ten_chuc_nang' => 'Đổi Tình Trạng Đơn Hàng'],
            ['id' => '37', 'ten_chuc_nang' => 'Lấy Danh Sách Chức Năng'],
            ['id' => '38', 'ten_chuc_nang' => 'Tạo Mới Chi Tiết Phân Quyền'],

        ]);
    }
}
