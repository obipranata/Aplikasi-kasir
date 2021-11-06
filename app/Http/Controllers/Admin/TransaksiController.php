<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index(){
        $data['transaksi'] = DB::select("SELECT penjualan.*, users.name FROM penjualan, users WHERE users.id = penjualan.user_id ORDER BY penjualan.tgl DESC");
        // dd($transaksi);
        return view('pages.admin.transaksi', $data);
    }

    public function getTransaksi($no_nota){
        $transaksi = DB::select("SELECT penjualan.*, produk.*, detail_penjualan.* FROM penjualan, produk, detail_penjualan WHERE penjualan.no_nota = detail_penjualan.no_nota AND produk.kd_produk = detail_penjualan.kd_produk AND penjualan.no_nota = '$no_nota' ");
        echo json_encode($transaksi);
    }
}
