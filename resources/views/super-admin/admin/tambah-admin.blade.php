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
                                <h1>Tambah Data Kategori Destinasi Wisata</h1>
                                <p>Silahkan masukkan data kategori wisata</p>
                                
                            {{-- </div> --}}
                        </div>
                        <form role="form" action="{{url('admin/kategori/tambah-kategori')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="clearfix" style="margin-top: 50px"></div>
                            <label>Nama Kategori</label>
                            <input type="text" name="kategori" class="form-control">
                            <br>
                            <label>Foto Kategori</label>
                            <input type="file" name="marker">
                            <br>
                            <a href="{{url('admin/kategori/data-kategori')}}" class="btn btn-danger pull-right"> Batal </a>
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