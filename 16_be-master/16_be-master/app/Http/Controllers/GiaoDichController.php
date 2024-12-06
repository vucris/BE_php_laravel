<?php

namespace App\Http\Controllers;

use App\Mail\ThanhToanDonHangMail;
use App\Models\DonHang;
use App\Models\GiaoDich;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

// Ai có tài khoản MB tự test tk MB của mình nha

class GiaoDichController extends Controller
{
    public function index()
    {
        $client = new Client();
        $payload = [
            "USERNAME"      => "THANHTRUONG2311",
            "PASSWORD"      => "Lethanhtruong2311@@",
            "DAY_BEGIN"     => Carbon::today()->format('d/m/Y'),
            "DAY_END"       => Carbon::today()->format('d/m/Y'),
            "NUMBER_MB"     => "1910061030119"
        ];

        try {
            $response = $client->post('http://103.137.185.71:2603/mb', [
                'json' => $payload
            ]);

            $data   = json_decode($response->getBody(), true);
            $duLieu = $data['data'];

            foreach($duLieu as $key => $value) {
                $giaoDich   = GiaoDich::where('pos', $value['pos'])
                                      ->where('creditAmount', $value['creditAmount'])
                                      ->where('description', $value['description'])
                                      ->first();

                if(!$giaoDich) {
                    GiaoDich::create([
                            'creditAmount'      =>  $value['creditAmount'],
                            'description'       =>  $value['description'],
                            'pos'               =>  $value['pos'],
                    ]);
                    // Khi mà chúng ta tạo giao dịch => tìm giao dịch dựa vào description => đổi trạng thái của đơn hàng
                    $description = $value['description'];
                    // Tìm vị trí của chuỗi "HDBH"
                    // $startIndex = strpos($description, "HDBH");
                    // if ($startIndex !== false) {
                    //     $maDonHang = substr($description, $startIndex, strcspn(substr($description, $startIndex), " \t\n\r\0\x0B"));
                    // }
                    if (preg_match('/HDBH(\d+)/', $description, $matches)) {
                        $maDonHang  = $matches[0];
                        $donHang    = DonHang::where('ma_don_hang', $maDonHang)
                                        ->where('tong_tien_thanh_toan', '<=', $value['creditAmount'])
                                        ->first();

                        if($donHang) {
                            $donHang->is_thanh_toan = 1;
                            $donHang->save();

                            $donHangMail = DonHang::join('khach_hangs', 'don_hangs.id_khach_hang', 'khach_hangs.id')
                                                ->select('don_hangs.*', 'khach_hangs.email')
                                                ->first();
                            // dd($donHangMail->toArray());
                            $bien_1['ma_don_hang']              =   $donHangMail->ma_don_hang;
                            $bien_1['ten_nguoi_nhan']           =   $donHangMail->ten_nguoi_nhan;
                            $bien_1['so_dien_thoai_nhan']       =   $donHangMail->so_dien_thoai;
                            $bien_1['dia_chi_nhan_hang']        =   $donHangMail->dia_chi_giao_hang;
                            $bien_1['tong_tien_thanh_toan']     =   $value['creditAmount'];
                            
                            Mail::to($donHangMail->email)->send(new ThanhToanDonHangMail($bien_1));
                        }
                    }
                }

                

            }

        } catch (Exception $e) {
            echo $e;
        }
    }
}
