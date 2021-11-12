<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class TransaksiController extends Controller
{
    public function index(){
        $data['transaksi'] = DB::select("SELECT penjualan.*, users.name FROM penjualan, users WHERE users.id = penjualan.user_id ORDER BY penjualan.tgl, penjualan.jam DESC");
        // dd($transaksi);
        return view('pages.admin.transaksi', $data);
    }

    public function getTransaksi($no_nota){
        $transaksi = DB::select("SELECT penjualan.*, produk.*, detail_penjualan.* FROM penjualan, produk, detail_penjualan WHERE penjualan.no_nota = detail_penjualan.no_nota AND produk.kd_produk = detail_penjualan.kd_produk AND penjualan.no_nota = '$no_nota' ");
        echo json_encode($transaksi);
    }
        // Generate PDF
        public function createPDF(Request $request) {
            // retreive all records from db
            $tgl_awal = $request->tgl_awal;
            $tgl_akhir = $request->tgl_akhir;
            $data['tgl_awal'] = $tgl_awal;
            $data['tgl_akhir'] = $tgl_akhir;
            $data['transaksi'] = DB::select(
                "SELECT 
                produk.nama_produk, kategori.nama_kategori, penjualan.*, detail_penjualan.*, users.name 
                FROM 
                users, kategori, produk, penjualan, detail_penjualan
                WHERE
                users.id = penjualan.user_id
                AND kategori.kd_kategori = produk.kd_kategori
                AND penjualan.no_nota = detail_penjualan.no_nota
                AND detail_penjualan.kd_produk = produk.kd_produk
                AND (penjualan.tgl BETWEEN '$tgl_awal' AND '$tgl_akhir')"
            );

            $data['transaksi_produk'] = DB::select(
                "SELECT 
                produk.nama_produk, kategori.nama_kategori, penjualan.*, detail_penjualan.*, users.name, sum(detail_penjualan.qty) as qty_produk, sum(detail_penjualan.harga_beli) as produk_bayar
                FROM 
                users, kategori, produk, penjualan, detail_penjualan
                WHERE
                users.id = penjualan.user_id
                AND kategori.kd_kategori = produk.kd_kategori
                AND penjualan.no_nota = detail_penjualan.no_nota
                AND detail_penjualan.kd_produk = produk.kd_produk
                AND (penjualan.tgl BETWEEN '$tgl_awal' AND '$tgl_akhir')
                GROUP BY produk.kd_produk"
            );

            $data['total_pendapatan'] = DB::select("SELECT SUM(total_bayar) as pendapatan FROM penjualan WHERE (tgl BETWEEN '$tgl_awal' AND '$tgl_akhir') "); 
            $data['total_qty'] = DB::select("SELECT SUM(detail_penjualan.qty) as total_item FROM penjualan, detail_penjualan WHERE penjualan.no_nota = detail_penjualan.no_nota AND (penjualan.tgl BETWEEN '$tgl_awal' AND '$tgl_akhir') "); 
      
            $pdf = PDF::loadview('pages.admin.laporan', $data)->setPaper('legal','landscape');
            return $pdf->stream();
            // $pdf = PDF::loadView('pages.admin.transaksi', $data);
      
            // return $pdf->download('pdf_file.pdf');
          }
}
