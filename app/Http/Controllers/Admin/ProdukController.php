<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use DNS1D;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function index(){
        $data['produk'] = DB::select("SELECT produk.*, kategori.* FROM produk,kategori WHERE produk.kd_kategori = kategori.kd_kategori");
        return view('pages.admin.produk.index', $data);
    }

    public function create(){
        $data['kategori'] = Kategori::all();
        return view('pages.admin.produk.create',$data);
    }

    public function store(Request $request){

        $kd_terakhir = DB::select("SELECT * FROM `produk` WHERE kd_kategori = '$request->kd_kategori' ORDER BY kd_produk DESC LIMIT 1");

        if(empty($kd_terakhir)){
            $kd_produk = "$request->kd_kategori"."001";
        }else{
            $kd_terakhir_produk = substr($kd_terakhir[0]->kd_produk, 3);
            $kd_produk = "$request->kd_kategori".sprintf('%03d', $kd_terakhir_produk+1);
        }

        $data = [
            'kd_produk' => $kd_produk,
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'kd_kategori' => $request->kd_kategori,
        ];

        // dd($kd_produk);

        Produk::create($data);

        return redirect('/admin/produk');
    }

    public function edit($kd_produk){
        $data['produk'] = Produk::where('kd_produk',$kd_produk)->first();
        $data['kategori'] = Kategori::all();
        return view('pages.admin.produk.edit',$data);
    }

    public function update(Request $request, $kd_produk){
        $data = [
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'kd_kategori' => $request->kd_kategori,
        ];

        Produk::where('kd_produk', $kd_produk)->update($data);

        return redirect('/admin/produk');
    }

    public function destroy($kd_produk){
        Produk::where('kd_produk', $kd_produk)->delete();

        return redirect('/admin/produk');
    }

    public function cetak($kd_produk){

        echo "
        <!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <title>Barcode</title>
</head>
<body>
<span style='text-align:center'>".DNS1D::getBarcodeHTML($kd_produk, 'CODABAR')."</br>
</body>
</html>
        <script >
        window.onload = function() { window.print(); }
       </script>
               ";
    }
}
