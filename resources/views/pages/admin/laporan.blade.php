<!DOCTYPE html>
<html>
<head>
<style>
img.center {
  display: block;
  margin-left: 33%;
}
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#detail {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 30%;
}
#detail td, #detail th {
  border: 1px solid #ddd;
  padding: 8px;
}
#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}
#customers tr:nth-child(even){background-color: #f2f2f2;}
#customers tr:hover {background-color: #ddd;}
#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
#detail tr:nth-child(even){background-color: #f2f2f2;}
#detail tr:hover {background-color: #ddd;}
#detail th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
</head>
<body>

    <img class="center" src="{{ public_path('img/logo.jpeg') }}" style="width: 35%;">
    <br>
    <h1 style="text-align: center">Laporan Penjualan {{$tgl_awal}} sampai {{$tgl_akhir}}</h1>

<table id="customers">
    <thead>
        <tr>
            <th>No</th>
            <th>No Nota</th>
            <th>Produk</th>
            <th>Qty</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Total Bayar</th>
            <th>Kasir</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 0;
        @endphp
        @foreach ($transaksi as $t)          
        <tr>
            <td>{{++$i}}</td>
            <td>{{$t->no_nota}}</td>
            <td>{{$t->nama_produk}}</td>
            <td style="text-align: center;">{{$t->qty}}</td>
            <td>{{$t->tgl}}</td>
            <td>{{$t->jam}}</td>
            <td>{{number_format($t->harga_beli)}}</td>
            <td>{{$t->name}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<br>

<h4 style="text-align: left">Detail Produk Terjual</h4>
<table id="detail">
    <thead>
        <tr>
            <th>No</th>
            <th>Produk</th>
            <th>Qty</th>
            <th>Total Bayar</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 0;
        @endphp
        @foreach ($transaksi_produk as $t)          
        <tr>
            <td>{{++$i}}</td>
            <td>{{$t->nama_produk}}</td>
            <td style="text-align: center;">{{$t->qty_produk}}</td>
            <td>{{number_format($t->produk_bayar)}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<br>
<p>
    Total produk terjual : {{$total_qty[0]->total_item}} item
</p>
<p>
    Pendapatan : Rp.{{number_format($total_pendapatan[0]->pendapatan)}}
</p>

</body>
</html>