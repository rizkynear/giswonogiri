@extends('layouts.master')

@section('content')

<div class="right_col" role="main">
  <div class="">
    @if (Session::has('success'))
      <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-check"></i> Information !</h4>
          {{Session::get('success')}}
      </div>
    @elseif (Session::has('error'))
      <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-check"></i> Information !</h4>
          {{Session::get('error')}}
      </div>
    @endif
    {{-- <div class="row"> --}}
   <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="page-title">
                            {{-- <div class="title_left"> --}}
                                <h1>Tambah Akun Admin</h1>
                                <p>Silahkan masukkan data admin</p>
                                
                            {{-- </div> --}}
                        </div>
                        <form role="form" action="{{ route('register') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="clearfix" style="margin-top: 50px"></div>
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}">
                            @if ($errors->has('nama'))
                                <span class="invalid-feedback" role="alert" style="color: #dc3545;">
                                    <strong>{{ $errors->first('nama') }}</strong>
                                </span>
                            @endif
                            <br>
                            <br>

                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert" style="color: #dc3545;">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            <br>
                            <br>

                            <label>Username</label>
                            <input type="text" name="username" class="form-control" value="{{ old('username') }}">
                            @if ($errors->has('username'))
                                <span class="invalid-feedback" role="alert" style="color: #dc3545;">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                            <br>
                            <br>

                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert" style="color: #dc3545;">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                            <br>
                            <br>

                            <label>Confirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                            <br>

                            <label>Foto</label>
                            <input type="file" name="foto">
                            @if ($errors->has('foto'))
                                <span class="invalid-feedback" role="alert" style="color: #dc3545;">
                                    <strong>{{ $errors->first('foto') }}</strong>
                                </span>
                            @endif
                            <br>
                            <br>

                            <a href="{{url('super-admin/admin/data-admin')}}" class="btn btn-danger pull-right"> Batal </a>
                            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-check"></i> Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
        {{-- </div> --}}
    <div class="clearfix"></div>
  </div>
</div>

@endsection