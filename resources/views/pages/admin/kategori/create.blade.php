@extends('layouts.admin')
    @section('title')
        Tambah Kategori - Admin
    @endsection

@section('content')
          <!-- Container Fluid-->
          <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">Tambah Kategori Baru</h1>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Kategori</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
              </ol>
            </div>
    
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
                            <form action="{{route('kategori.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
    
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Nama Kategori</label>
                                            <input type="text" name="nama_kategori" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="row">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-success px-5">Simpan</button>
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
