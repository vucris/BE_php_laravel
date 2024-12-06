<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DaiLySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dai_lys')->delete();

        DB::table('dai_lys')->truncate();

        DB::table('dai_lys')->insert([
            ['id' => '1', 'ho_va_ten' => 'Lê Thanh Trường', 'email' => 'quoclongdng@gmail.com', 'so_dien_thoai' => '376659652', 'ngay_sinh' => '2023-12-10', 'password' => bcrypt(123456), 'ten_doanh_nghiep' => 'DZFullStack', 'ma_so_thue' => '123123',  'dia_chi_kinh_doanh' => 'Đà Nẵng', 'is_active' => 1],
            ['id' => '2', 'ho_va_ten' => 'Phan Minh Tiến', 'email' => 'info@sontungjeans.com', 'so_dien_thoai' => '123123123', 'ngay_sinh' => '2022-12-10', 'password' => bcrypt(123456), 'ten_doanh_nghiep' => 'CÔNG TY TNHH SƠN TÙNG', 'ma_so_thue' => '300588569',  'dia_chi_kinh_doanh' => '39/5 Hoàng Dư Khương, Phường 12, Q. 10, Tp. Hồ Chí Minh (TPHCM)', 'is_active' => 1],
            ['id' => '3', 'ho_va_ten' => 'Ms. Cao Thị Cẩm', 'email' => 'phatthienthanh@gmail.com', 'so_dien_thoai' => '123123123', 'ngay_sinh' => '2021-12-10', 'password' => bcrypt(123456), 'ten_doanh_nghiep' => 'CÔNG TY TNHH PHÁT THIÊN THANH', 'ma_so_thue' => '151323569',  'dia_chi_kinh_doanh' => 'Thửa đất số 615, tờ bản đồ số 39, Khu phố Khánh Lộc, P.Khánh Bình, Tx Tân Uyên, Tỉnh Bình Dương', 'is_active' => 1],
            ['id' => '4', 'ho_va_ten' => 'Nguyễn Văn ANMAC', 'email' => 'anmac.vn@gmail.com', 'so_dien_thoai' => '123123123', 'ngay_sinh' => '2023-12-10', 'password' => bcrypt(123456), 'ten_doanh_nghiep' => 'CÔNG TY TNHH ANMAC VIỆT NAM', 'ma_so_thue' => '321288123',  'dia_chi_kinh_doanh' => 'Tòa Nhà 19, N7B, Trung Hòa, Nhân Chính, Quận Thanh Xuân, TP Hà Nội (TPHN)', 'is_active' => 1],
            ['id' => '5', 'ho_va_ten' => 'Mr. Thành', 'email' => 'sales@quanhao.vn', 'so_dien_thoai' => '123123122', 'ngay_sinh' => '2023-05-10', 'password' => bcrypt(123456), 'ten_doanh_nghiep' => 'CÔNG TY TNHH QUÂN HÀO', 'ma_so_thue' => '1231288123',  'dia_chi_kinh_doanh' => '46/39 Đường Hoàng Hoa Thám, KP. 3, P. Phú Lợi, TP. Thủ Dầu Một, Bình Dương', 'is_active' => 1],
            ['id' => '6', 'ho_va_ten' => 'Mr. Thảo', 'email' => 'vietabusin@gmail.com', 'so_dien_thoai' => '123123123', 'ngay_sinh' => '2023-06-10', 'password' => bcrypt(123456), 'ten_doanh_nghiep' => 'CÔNG TY TNHH ĐẦU TƯ VÀ KINH DOANH VIỆT Á', 'ma_so_thue' => '11231288123',  'dia_chi_kinh_doanh' => 'Số 11A, Đường 2.2, Khu Đô Thị Gamuda Gardens, Trần Phú, Quận Hoàng Mai, TP. Hà Nội (TPHN)', 'is_active' => 1],
            ['id' => '7', 'ho_va_ten' => 'Trần Thanh Hải', 'email' => 'vietabusin@gmail.com', 'so_dien_thoai' => '123123121', 'ngay_sinh' => '2023-12-10', 'password' => bcrypt(123456), 'ten_doanh_nghiep' => 'CÔNG TY TNHH SẢN XUẤT THƯƠNG MẠI QUỐC TẾ KHANG THỊNH', 'ma_so_thue' => '1321288123',  'dia_chi_kinh_doanh' => '25/22 Bùi Quang Là, Phường 12, Quận Gò Vấp, TP Hồ Chí Minh (TPHCM)', 'is_active' => 1],
        ]);
    }
}
