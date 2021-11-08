<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Detail_penjualan;
use App\Models\Penjualan;
use Redirect,Response;

class TransaksiController extends Controller
{
    public function index(){
        
        return view('pages.kasir.transaksi');
    }

    public function getProduk($kd_produk){
        $produk = Produk::where(['kd_produk'=>$kd_produk])->first();

        return Response::json($produk);
    }

    public function store(Request $request){
        $tunai = $request->tunai;
        $konvert_tunai = str_replace(".","",$tunai);
        date_default_timezone_set("Asia/Jayapura");
        $no_nota = time();
        $papua = date("H:i:s");
        $nama = $request->user()->name;
        $kembalian = $konvert_tunai - $request->jumlah_total;
    
        $penjualan = [
            'no_nota' => $no_nota,
            'tgl' => date('Y-m-d'),
            'jam' => $papua,
            'total_bayar' => $request->jumlah_total,
            'tunai' => $konvert_tunai,
            'kembalian' => $kembalian,
            'user_id' => $request->user()->id
        ];
        Penjualan::create($penjualan);
        for($i=0; $i < count($request->kd_produk); $i++){
            $detail_penjualan =[
                'no_nota' => $no_nota,
                'kd_produk' => $request->kd_produk[$i],
                'harga_beli' => $request->qty[$i] * $request->harga[$i],
                'qty' => $request->qty[$i],
            ];

            Detail_penjualan::create($detail_penjualan);
        }

        echo "
        <html>
<head>
<title>Struk Pembayaran</title>
<style>
 
#tabel
{
font-size:15px;
border-collapse:collapse;
}
#tabel  td
{
border: 1px solid black;
}
</style>
</head>
<body style='font-family:tahoma; font-size:8pt;'>
<center><table style='width:350px; font-size:16pt; font-family:calibri; border-collapse: collapse;' border = '0'>
<td width='70%' align='CENTER' vertical-align:top'><span style='color:black;'>
</br>Mega Futsal Abepura</span></br>
 
 
<span style='font-size:12pt'>No. : ".$no_nota.", ". date('d-m-Y') ."</span></br>
<span style='font-size:12pt'>Kasir: ".$nama."</span></br>
<span style='font-size:12pt'>".$papua."</span></br>
</td>
</table>
<style>
hr { 
    display: block;
    margin-top: 0.5em;
    margin-bottom: 0.5em;
    margin-left: auto;
    margin-right: auto;
    border-style: inset;
    border-width: 1px;
} 
</style>
<table cellspacing='0' cellpadding='0' style='width:320px; font-size:12pt; font-family:calibri;  border-collapse: collapse;' border='0'>
<br><br>
";
for($i=0; $i < count($request->kd_produk); $i++){
    $produk = Produk::where(['kd_produk'=>$request->kd_produk[$i]])->first();
    $total = $request->qty[$i] * $produk->harga;
    $qty = $request->qty[$i];
    $no = $i+1;
echo "
<tr>
<td style='vertical-align:top;'>".$no.". ".$produk->nama_produk." x ".$qty." x ".number_format($produk->harga). " = ".number_format($total)."</td>
</tr>
<tr>";
}
echo "
<td colspan='5'><hr></td>
</tr>
<tr>
<td colspan = '3'><div  color:black'>Total : ".number_format($request->jumlah_total)."</div></td>
</tr>
<tr>
<td colspan = '3'><div  color:black'>Cash : ".number_format($konvert_tunai)."</div></td>
</tr>
<tr>
<td colspan = '3'><div  color:black'>Kembalian : ".number_format($kembalian)."</div></td>
</tr>
</table>
<table style='width:350; font-size:12pt;' cellspacing='2'><tr></br><td align='center'> TERIMAKASIH</br></td></tr></table></center></body>
<table style='width:350; font-size:12pt;' cellspacing='2'><tr></br><td align='center'>=============</br></td></tr></table></center></body>
</html>
        <script >
 window.onload = function() { window.print(); }
</script>
        ";

        // return redirect('/kasir');
    } 

}
