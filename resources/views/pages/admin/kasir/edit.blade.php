@extends('layouts.admin')
    @section('title')
        Tambah Petugas Kasir - Admin
    @endsection

@section('content')
          <!-- Container Fluid-->
          <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">Edit Petugas</h1>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Kasir</a></li>
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
                            <form action="{{route('kasir.update', $kasir->id)}}" method="post" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
    
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Nama Petugas</label>
                                            <input type="text" name="name" class="form-control" required value="{{$kasir->name}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Username</label>
                                            <input type="text" name="email" class="form-control" required value="{{$kasir->email}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="col-md-4 col-form-label ">{{ __('Password') }}</label>
                                                <input id="password" type="password" class="form-control" name="password">
                                        </div>
                                    </div>
                                </div>
    
                                <div class="row">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-success px-5" name="submit">Simpan</button>
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
