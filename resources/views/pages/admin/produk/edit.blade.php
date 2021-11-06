@extends('layouts.admin')
    @section('title')
        Edit Produk - Admin
    @endsection

@section('content')
          <!-- Container Fluid-->
          <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">Edit Produk</h1>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Produk</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                            <form action="{{route('produk.update', $produk->kd_produk)}}" method="post" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
    
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Nama Produk</label>
                                            <input type="text" name="nama_produk" class="form-control" required value="{{$produk->nama_produk}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Harga</label>
                                            <input type="number" name="harga" class="form-control" required value="{{$produk->harga}}"">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Stok</label>
                                            <input type="number" name="stok" class="form-control" required value="{{$produk->stok}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="kd_kategori">Kategori</label>
                                            <select class="form-control" id="kd_kategori" name="kd_kategori" required>
                                                @foreach ($kategori as $k)
                                                    @if ($produk->kd_kategori == $k->kd_kategori)
                                                        @php
                                                            $select = 'selected';
                                                        @endphp
                                                    @else
                                                        @php
                                                            $select = '';
                                                        @endphp
                                                    @endif
                                                    <option {{$select}} value="{{$k->kd_kategori}}">{{$k->nama_kategori}}</option>
                                                @endforeach
                                            </select>
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
