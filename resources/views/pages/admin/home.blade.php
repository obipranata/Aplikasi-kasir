@extends('layouts.admin')
    @section('title')
        Dashboard - Admin
    @endsection

@section('content')

      <!-- Container Fluid-->
      <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
          </ol>
        </div>

        <div class="row mb-3">
          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Pendapatan (Bulanan)</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format($pendapatan[0]->pendapatan)}}</div>
                    <div class="mt-2 mb-0 text-muted text-xs">
                      <span>bulan ini</span>
                    </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-primary"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Earnings (Annual) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Total Penjualan</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format($penjualan[0]->pembelian)}}</div>
                    <div class="mt-2 mb-0 text-muted text-xs">
                      <span>bulan ini</span>
                    </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-shopping-cart fa-2x text-success"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- New User Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Pembelian</div>
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{number_format($pembelian[0]->transaksi)}}</div>
                    <div class="mt-2 mb-0 text-muted text-xs">
                      <span>bulan ini</span>
                    </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-users fa-2x text-info"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Pending Requests Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Pendapatan</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format($pendapatan_harian[0]->pendapatan)}}</div>
                    <div class="mt-2 mb-0 text-muted text-xs">
                      <span>hari ini</span>
                    </div>
                  </div>
                  <div class="col-auto">
                    <!-- <i class="fas fa-comments fa-2x text-warning"></i> -->
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Invoice Example -->
          <div class="col-sm-12 mb-4">
            <div class="card">
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Pembelian terbaru</h6>
                <a class="m-0 float-right btn btn-danger btn-sm" href="/admin/transaksi">Selengkapnya... <i
                    class="fas fa-chevron-right"></i></a>
              </div>
              <div class="table-responsive">
                <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr>
                      <th>No Nota</th>
                      <th>Tgl</th>
                      <th>Jam</th>
                      <th>Total Bayar</th>
                      <th>Cash</th>
                      <th>Kembalian</th>
                      <th>Kasir</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($transaksi as $t)
                      <tr>
                        <td><a href="#">{{$t->no_nota}}</a></td>
                        <td>{{$t->tgl}}</td>
                        <td>{{$t->jam}}</td>
                        <td>{{number_format($t->total_bayar)}}</td>
                        <td>{{number_format($t->tunai)}}</td>
                        <td>{{number_format($t->kembalian)}}</td>
                        <td><span class="badge badge-success">{{$t->name}}</span></td>
                        <td>
                          <button class="btn btn-info btn-sm btn-informasi" data-nota ="{{$t->no_nota}}" data-toggle="modal" data-target="#detailModal">
                            <i class="fas fa-fw fa-eye"></i>
                          </button>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="card-footer"></div>
            </div>
          </div>
        </div>
    
        <div class="row">
                    <!-- Area Chart -->
                    <div class="col-sm-12">
                      <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                          <h6 class="m-0 font-weight-bold text-primary">Grafik Pendapatan Per Bulan</h6>
                        </div>
                        <div class="card-body">
                          <div class="chart-area">
                            <canvas id="myChart" style="width: 100%" height="300"></canvas>
                          </div>
                        </div>
                      </div>
                    </div>
        </div>

      </div>
      <!---Container Fluid-->

                   {{-- modal --}}
                   <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modal-label">Informasi Penjualan</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <h6 id="no_nota">
                          </h6>
                          <table class="table table-borderless">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kode</th>
                                <th scope="col">Item</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Total</th>
                              </tr>
                            </thead>
                            <tbody id="info-transaksi">
                              
                            </tbody>
                          </table>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>

@endsection

@push('addon-script')

<script>
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [<?php
          foreach($grafik as $g){
            $bulan = $g->bulan;

            echo "'".$bulan."',";
          }
        ?>],
        datasets: [{
            label: 'Pendapatan',
            data: [
              <?php
                foreach($grafik as $g){
                  $total_bayar_bulan = $g->total_bayar_bulan;

                  echo "'".$total_bayar_bulan."',";
                }
              ?>
            ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

<script>
        $(document).ready(function(){
            function formatNumber(num) {
                return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.btn-informasi').click(function(){
              $("#info-transaksi").html('');

              let nota = $(this).data('nota');
                $.get('/admin/getTransaksi/' + nota, function(data){
                  transaksi = JSON.parse(data);
                  console.log(transaksi[0]);
                  $("#no_nota").html(`No Nota: ${transaksi[0].no_nota}`);
                  for (var i = 0; i < transaksi.length; i++) {
                      console.log(transaksi[i].kd_produk);
                  
                    $("#info-transaksi").append(`
                      <tr>
                        <th scope="row">${i+1}</th>
                        <td>${transaksi[i].kd_produk}</td>
                        <td>${transaksi[i].nama_produk}</td>
                        <td>${transaksi[i].qty}</td>
                        <td>${formatNumber(transaksi[i].harga)}</td>
                        <td>${formatNumber(transaksi[i].harga * transaksi[i].qty)}</td>
                      </tr>
                    `);
                  }
                });
            });

        });
    </script>
@endpush