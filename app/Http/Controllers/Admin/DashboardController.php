<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        date_default_timezone_set("Asia/Jayapura");
        $hari = date('d');
        $bulan = date('m');
        $tahun = date('Y');
        // dd($hari);
        $data['pendapatan_harian'] = DB::select("SELECT SUM(total_bayar) as pendapatan FROM penjualan WHERE day(penjualan.tgl) = '$hari' AND month(tgl) = '$bulan' AND YEAR(penjualan.tgl) = '$tahun' ");
        $data['pendapatan'] = DB::select("SELECT SUM(total_bayar) as pendapatan FROM penjualan WHERE month(tgl) = '$bulan' AND YEAR(penjualan.tgl) = '$tahun' ");
        $data['pembelian'] = DB::select("SELECT COUNT(no_nota) as transaksi FROM penjualan");
        $data['penjualan'] = DB::select("SELECT SUM(detail_penjualan.qty) as pembelian FROM penjualan, detail_penjualan WHERE penjualan.no_nota = detail_penjualan.no_nota AND month(tgl) = '$bulan' AND YEAR(penjualan.tgl) = '$tahun'");
        $data['grafik'] = DB::select("SELECT MONTHNAME(penjualan.tgl) as bulan, penjualan.*, SUM(penjualan.total_bayar) as total_bayar_bulan FROM penjualan WHERE YEAR(penjualan.tgl) = '$tahun' GROUP BY month(penjualan.tgl) ");

        $data['transaksi'] = DB::select("SELECT penjualan.*, users.name FROM users, penjualan WHERE penjualan.user_id = users.id ORDER BY penjualan.tgl DESC LIMIT 5 ");
        // dd($data);
        return view('pages.admin.home', $data);
    }

}
