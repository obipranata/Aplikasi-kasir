@extends('layouts.admin')
    @section('title')
        Produk - Admin
    @endsection

@section('content')
            <!-- Container Fluid-->
            <div class="container-fluid" id="container-wrapper">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                  <h1 class="h3 mb-0 text-gray-800">Data Transaksi</h1>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item">Transaksi</li>
                    <li class="breadcrumb-item active" aria-current="page">index</li>
                  </ol>
                </div>
      
                <!-- Row -->
                <div class="row">
                  <!-- DataTable with Hover -->
                  <div class="col-lg-12">
                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#exportModal">
                      Export PDF
                    </button>

                    <div class="card mb-4 mt-4">

                      <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTableeHover">
                          <thead class="thead-light">
                            <tr>
                              <th>No</th>
                              <th>No Nota</th>
                              <th>Tanggal</th>
                              <th>Jam</th>
                              <th>Harga Diskon</th>
                              <th>Harga Kotor</th>
                              <th>Total Bayar</th>
                              <th>Cash</th>
                              <th>Kembalian</th>
                              <th>Kasir</th>
                              <th>Detail</th>
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
                                <td>{{$t->tgl}}</td>
                                <td>{{$t->jam}}</td>
                                <td>{{$t->harga_diskon}}</td>
                                <td>{{$t->total_bayar + $t->harga_diskon}}</td>
                                <td>{{$t->total_bayar}}</td>
                                <td>{{$t->tunai}}</td>
                                <td>{{$t->kembalian}}</td>
                                <td>{{$t->name}}</td>
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
                    </div>
                  </div>
                </div>
                <!--Row-->
      
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
                      <div class="table-responsive">
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
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>

              {{-- modal export--}}
              <div class="modal fade" id="exportModal" tabindex="-1" role="dialog" aria-labelledby="exportModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modal-label">Export PDF</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form method="POST" action="/admin/transaksi/laporan">
                      @csrf
                      <div class="modal-body">
                          <div class="form-row">
                            <div class="col">
                              <label for="">Tanggal Awal</label>
                              <input type="date" class="form-control" name="tgl_awal">
                            </div>
                            <div class="col">
                              <label for="">Tanggal Akhir</label>
                              <input type="date" class="form-control" name="tgl_akhir">
                            </div>
                          </div>
                        
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Export</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
@endsection

@push('addon-script')
<script src="/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script>
  $(document).ready(function () {
    $('#dataTable').DataTable(); // ID From dataTable 
    $('#dataTableHover').DataTable(); // ID From dataTable with Hover
  });
</script>
@endpush

@push('addon-script')
    <script>
        $(document).ready(function(){
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
                        <td>${transaksi[i].harga}</td>
                        <td>${transaksi[i].harga * transaksi[i].qty}</td>
                      </tr>
                    `);
                  }
                });
            });

        });
    </script>
@endpush