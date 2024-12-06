<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DanhMucSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('danh_mucs')->delete();

        DB::table('danh_mucs')->truncate();

        DB::table('danh_mucs')->insert([
            ['id' => '4', 'ten_danh_muc' => 'Thiết Bị Điện Tử', 'slug_danh_muc' => 'thiet-bi-dien-tu', 'tinh_trang' => '1', 'id_danh_muc_cha' => '0', 'hinh_anh' => 'https://down-vn.img.susercontent.com/file/978b9e4cb61c611aaaf58664fae133c5_tn&quot'],
            ['id' => '5', 'ten_danh_muc' => 'Phụ Kiện Điện Tử', 'slug_danh_muc' => 'phu-kien-dien-tu', 'tinh_trang' => '1', 'id_danh_muc_cha' => '0', 'hinh_anh' => 'https://bizweb.dktcdn.net/100/376/459/articles/linh-kien-may-tinh.jpg?v=1632590426060'],
            ['id' => '6', 'ten_danh_muc' => 'Tivi và Thiết Bị Điện Gia Dụng', 'slug_danh_muc' => 'tivi-va-thiet-bi-dien-gia-dung', 'tinh_trang' => '1', 'id_danh_muc_cha' => '0', 'hinh_anh' => 'https://linhvucbanle.com/wp-content/uploads/2021/03/do-dien-trong-gia-dinh.jpg'],
            ['id' => '7', 'ten_danh_muc' => 'Sức Khỏe Và Làm Đẹp', 'slug_danh_muc' => 'suc-khoe-va-lam-dep', 'tinh_trang' => '1', 'id_danh_muc_cha' => '0', 'hinh_anh' => 'https://giadungthongminhvn.com/Systems/2020/02/24/suc-khoe-va-lam-dep.png'],
            ['id' => '8', 'ten_danh_muc' => 'Hàng Mẹ, Bé Và Đồ Chơi', 'slug_danh_muc' => 'hang-me-be-va-do-choi', 'tinh_trang' => '1', 'id_danh_muc_cha' => '0', 'hinh_anh' => 'https://unmei.com.vn/wp-content/uploads/2022/03/63a353f22abe1fc092f3deb994ac8c37.jpg'],
            ['id' => '9', 'ten_danh_muc' => 'Thời Trang Nam', 'slug_danh_muc' => 'thoi-trang-nam', 'tinh_trang' => '1', 'id_danh_muc_cha' => '0', 'hinh_anh' => 'https://aristino.com/Data/ResizeImage/images/product/so-mi-dai-tay/alsr10/ao-so-mi-ALSR10-02x900x900x4.webp'],
            ['id' => '10', 'ten_danh_muc' => 'Thời Trang Nữ', 'slug_danh_muc' => 'thoi-trang-nu', 'tinh_trang' => '1', 'id_danh_muc_cha' => '0', 'hinh_anh' => 'https://i.pinimg.com/474x/f7/aa/c5/f7aac54dfaa15184cb6e801d76984084.jpg'],
            ['id' => '11', 'ten_danh_muc' => 'Điện Thoại Di Động', 'slug_danh_muc' => 'dien-thoai-di-dong', 'tinh_trang' => '1', 'id_danh_muc_cha' => '4', 'hinh_anh' => 'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:0/q:80/plain/https://cellphones.com.vn/media/wysiwyg/Phone/Dien-thoai-2.jpg'],
            ['id' => '12', 'ten_danh_muc' => 'Máy Tính Bảng', 'slug_danh_muc' => 'may-tinh-bang', 'tinh_trang' => '1', 'id_danh_muc_cha' => '4', 'hinh_anh' => 'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:0/q:80/plain/https://cellphones.com.vn/media/wysiwyg/tablet/May-tinh-bang-8.jpg'],
            ['id' => '13', 'ten_danh_muc' => 'LapTop', 'slug_danh_muc' => 'laptop', 'tinh_trang' => '1', 'id_danh_muc_cha' => '4', 'hinh_anh' => 'https://cdn.nguyenkimmall.com/images/detailed/828/10053095-laptop-lenovo-ideapad-3-14iau7-82rj0019vn-1.jpg'],
            ['id' => '14', 'ten_danh_muc' => 'Máy Tính Bàn', 'slug_danh_muc' => 'may-tinh-ban', 'tinh_trang' => '1', 'id_danh_muc_cha' => '4', 'hinh_anh' => 'https://img.tgdd.vn/imgt/f_webp,fit_outside,quality_100/https://cdn.tgdd.vn//News/1501313//may-tinh-de-ban-5-800x450.jpg'],
            ['id' => '15', 'ten_danh_muc' => 'Phụ Kiện Di Động', 'slug_danh_muc' => 'phu-kien-di-dong', 'tinh_trang' => '1', 'id_danh_muc_cha' => '5', 'hinh_anh' => 'https://phukienre.com.vn/wp-content/uploads/2020/08/phu-kien-gia-si-cua-dien-thoai-co-tai-le-han-1.jpg'],
            ['id' => '16', 'ten_danh_muc' => 'Thiết Bị Thông Minh', 'slug_danh_muc' => 'thiet-bi-thong-minh', 'tinh_trang' => '1', 'id_danh_muc_cha' => '5', 'hinh_anh' => 'https://sudospaces.com/lumi/uploads/2017/08/thiet-bi-dien-thong-minh-lumi.jpg'],
            ['id' => '17', 'ten_danh_muc' => 'Thiết Bị Số', 'slug_danh_muc' => 'thiet-bi-so', 'tinh_trang' => '1', 'id_danh_muc_cha' => '5', 'hinh_anh' => 'https://e.khoahoc.tv/photos/image/122011/24/thietbiso.jpg'],
            ['id' => '18', 'ten_danh_muc' => 'Ti Vi', 'slug_danh_muc' => 'ti-vi', 'tinh_trang' => '1', 'id_danh_muc_cha' => '6', 'hinh_anh' => 'https://cdn.tgdd.vn/Products/Images/1942/310792/google-tivi-aqua-4k-55-inch-2.jpg'],
            ['id' => '19', 'ten_danh_muc' => 'Thiết Bị Gia Dụng', 'slug_danh_muc' => 'thiet-bi-gia-dung', 'tinh_trang' => '1', 'id_danh_muc_cha' => '6', 'hinh_anh' => 'https://giadungsato.com/Uploads/images/giadungsato(2).jpg'],
            ['id' => '20', 'ten_danh_muc' => 'Chăm Sóc Da', 'slug_danh_muc' => 'cham-soc-da', 'tinh_trang' => '1', 'id_danh_muc_cha' => '7', 'hinh_anh' => 'https://careline.vn/uploaded/images/d%C6%B0%E1%BB%A1ng-da-5(1).jpg'],
            ['id' => '21', 'ten_danh_muc' => 'Dụng Cụ Trang Điểm', 'slug_danh_muc' => 'dung-cu-trang-diem', 'tinh_trang' => '1', 'id_danh_muc_cha' => '7', 'hinh_anh' => 'https://tutinminhdep.com/wp-content/uploads/2020/10/nhung-dung-cu-trang-diem-can-thiet.jpg'],
            ['id' => '22', 'ten_danh_muc' => 'Thời Trang Cho Bé', 'slug_danh_muc' => 'thoi-trang-cho-be', 'tinh_trang' => '1', 'id_danh_muc_cha' => '8', 'hinh_anh' => 'https://cdn.becungshop.vn/images/500x500/bo-thun-sieu-ngau-gduck-cho-be-trai-p2509028c2b4d0-500x500.jpg'],
            ['id' => '23', 'ten_danh_muc' => 'Đồ Chơi Cho bé', 'slug_danh_muc' => 'do-choi-cho-be', 'tinh_trang' => '1', 'id_danh_muc_cha' => '8', 'hinh_anh' => 'https://bizweb.dktcdn.net/100/226/134/products/hop-tri-tue-8-chuc-nang-1-min.jpg?v=1548172802750'],
            ['id' => '24', 'ten_danh_muc' => 'Trang Phục Nữ', 'slug_danh_muc' => 'trang-phuc-nu', 'tinh_trang' => '1', 'id_danh_muc_cha' => '10', 'hinh_anh' => 'https://dongphuchaianh.vn/wp-content/uploads/2022/03/trang-phuc-cong-so-nu-yeu-kieu.jpg'],
            ['id' => '25', 'ten_danh_muc' => 'Giày Nữ', 'slug_danh_muc' => 'giay-nu', 'tinh_trang' => '1', 'id_danh_muc_cha' => '10', 'hinh_anh' => 'https://satajor.com/wp-content/uploads/2019/09/SJ0095-web-tr%E1%BA%AFng-2.jpg'],
            ['id' => '26', 'ten_danh_muc' => 'Đồng Hồ Nữ', 'slug_danh_muc' => 'dong-ho-nu', 'tinh_trang' => '1', 'id_danh_muc_cha' => '10', 'hinh_anh' => 'https://cdn.belovedbeyond.com/photos/view/photos/larges/novatime.D623602/64742300cbe09f41e200b9d5.D623602.belove-beyond-personal-gift-platform.webp'],
            ['id' => '27', 'ten_danh_muc' => 'Trang Phục Nam', 'slug_danh_muc' => 'trang-phuc-nam', 'tinh_trang' => '1', 'id_danh_muc_cha' => '9', 'hinh_anh' => 'https://dongphuchaianh.vn/wp-content/uploads/2022/03/trang-phuc-cong-so-cho-nam-so-mi.jpg'],
            ['id' => '28', 'ten_danh_muc' => 'Giày Nam', 'slug_danh_muc' => 'giay-nam', 'tinh_trang' => '1', 'id_danh_muc_cha' => '9', 'hinh_anh' => 'https://kaiwings.vn/upload/product/kw-037/thumb/giay-nam-dep-cong-so-cao-cap-chinh-hang-tre-trung_x450.jpg'],

        ]);
    }
}
