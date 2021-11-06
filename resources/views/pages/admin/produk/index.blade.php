@extends('layouts.admin')
    @section('title')
        Produk - Admin
    @endsection

@section('content')
            <!-- Container Fluid-->
            <div class="container-fluid" id="container-wrapper">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                  <h1 class="h3 mb-0 text-gray-800">List Produk</h1>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item">Produk</li>
                    <li class="breadcrumb-item active" aria-current="page">index</li>
                  </ol>
                </div>
      
                <!-- Row -->
                <div class="row">
                  <!-- DataTable with Hover -->
                  <div class="col-lg-12">
                    <div class="card mb-4">
                      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        {{-- <h6 class="m-0 font-weight-bold text-primary">DataTables with Hover</h6> --}}
                        <a href="/admin/produk/create" class="btn btn-sm btn-primary">Tambah Produk Baru</a>
                      </div>
                      <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                          <thead class="thead-light">
                            <tr>
                              <th>No</th>
                              <th>Kategori</th>
                              <th>Nama Produk</th>
                              <th>Harga</th>
                              <th>Stok</th>
                              {{-- <th>Barcode</th> --}}
                              <th>Edit</th>
                              <th>Hapus</th>
                              {{-- <th>Cetak</th> --}}
                            </tr>
                          </thead>
                          <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($produk as $p)          
                              <tr>
                                <td>{{++$i}}</td>
                                <td>{{$p->nama_kategori}}</td>
                                <td>{{$p->nama_produk}}</td>
                                <td>{{$p->harga}}</td>
                                <td>{{$p->stok}}</td>
                                {{-- <td>
                                    {!! DNS1D::getBarcodeHTML($p->kd_produk, 'CODABAR') !!}
                                </td> --}}
                                <td>
                                  <a href="/admin/produk/{{$p->kd_produk}}/edit" class="btn btn-warning btn-sm">
                                    <i class="fas fa-fw fa-edit"></i>
                                  </a>
                                </td>
                                <td>
                                  <form action="{{route('produk.destroy', $p->kd_produk)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">
                                      <i class="fas fa-fw fa-trash"></i>
                                    </button>
                                  </form>
                                </td>
                                {{-- <td>
                                  <form action="/admin/cetak-barcode/{{$p->kd_produk}}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-info btn-sm">
                                      <i class="fas fa-fw fa-print"></i>
                                    </button>
                                  </form>
                                </td> --}}
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <!--Row-->
      
      
                <!-- Modal Logout -->
                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
                  aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>Are you sure you want to logout?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                        <a href="login.html" class="btn btn-primary">Logout</a>
                      </div>
                    </div>
                  </div>
                </div>
      
            </div>
              <!---Container Fluid-->
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