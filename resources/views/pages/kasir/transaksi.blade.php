@extends('layouts.kasir')
    @section('title')
        Transaksi - Kasir
    @endsection

    @push('addon-style')
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endpush

@section('content')
          <!-- Container Fluid-->
          <div class="container-fluid" id="container-wrapper">
            {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">Transaksi Pembelian Produk</h1>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Transaksi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
              </ol>
            </div> --}}
    
            <div class="row">
                <div class="col-md-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <label for="">Qty</label>
                                  <input type="number" class="form-control" value="1" id="input-qty">
                                </div>
                                  <div class="col">
                                    <label for="">Kode Produk</label>
                                    <input type="text" class="form-control" autofocus id="input-kd_produk">
                                  </div>
                                  {{-- <div class="col">
                                      <label for="" class="text-white"></label>
                                    <button class="btn btn-warning btn-block mt-3 mb-3" id="next">OK</button>
                                  </div> --}}
                                </div>
                            <br>
                            <h4 id="total-harga" class="mb-2">
                                0
                            </h4>
                            <form action="/kasir/transaksi/store" method="post" enctype="multipart/form-data">
                                @csrf
    
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table align-items-center table-flush">
                                              <thead class="thead-light">
                                                <tr>
                                                  <th>Kode Produk</th>
                                                  <th>Nama Produk</th>
                                                  <th>Qty</th>
                                                  <th>Harga</th>
                                                </tr>
                                              </thead>
                                              <tbody id="list-belanja">
                                                  
                                              </tbody>
                                            </table>
                                          </div>
                                    </div>
                                </div>
    
                                <div class="row mt-3">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="pembayaran" id="tunai" name="tunai" autocomplete="off" required>
                                            <input type="hidden" class="form-control" placeholder="jumlah-total" id="jumlah-total" name="jumlah_total">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <button type="submit" id="btn-save" class="btn btn-success px-5">Sumbit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>           
            </div>
    
          </div>
          <!---Container Fluid-->
    
@endsection

@push('addon-script')
    <script>
        $(document).ready(function(){

            function formatNumber(num) {
                return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
            }

            var tunai = document.getElementById('tunai');
            tunai.addEventListener('keyup', function(e){
                // tambahkan 'Rp.' pada saat form di ketik
                // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                tunai.value = formatRupiah(this.value);
            });

            		/* Fungsi formatRupiah */
            function formatRupiah(angka, prefix){
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split   		= number_string.split(','),
                sisa     		= split[0].length % 3,
                rupiah     		= split[0].substr(0, sisa),
                ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
    
                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if(ribuan){
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
    
                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            }


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let jumlah = 0;
            $('#input-kd_produk').keypress(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode == '13'){
                kd_produk = $("#input-kd_produk").val();
                qty = $("#input-qty").val();

                $.get('/kasir/getProduk/' + kd_produk, function(data){
                    if (data.kd_produk){
                        $("#list-belanja").append(`

                        <tr>
                            <td>
                                <input type="hidden" name="kd_produk[]" value="${data.kd_produk}">
                                ${data.kd_produk}                  
                            </td>
                            <td>
                                ${data.nama_produk}
                            </td>
                            <td>
                                <input type="hidden" name="qty[]" style="width: 50px" value="${qty}">
                                ${qty}                        
                            </td>
                            <td>
                                <input type="hidden" name="harga[]" value="${data.harga}">
                                ${formatNumber(data.harga * qty)} 
                            </td>
                        </tr>
                        
                        `);
                        jumlah = jumlah + data.harga * qty;
                        $("#total-harga").html(`Total Rp.${formatNumber(jumlah)}`);
                        $("#jumlah-total").val(`${jumlah}`);
                    }else {
                        alert('Produk tidak ditemukan');
                    }
                });

                $("#input-kd_produk").val('');
                $("#input-qty").val('1');
                $("#input-kd_produk").focus();
                }
            });

            $("#btn-save").on('click', function(){
                tunai = $('#tunai').val();
            });
        });
    </script>
@endpush
