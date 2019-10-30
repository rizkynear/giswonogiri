@extends('layouts.master')

<link href="{{asset('backend/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('backend/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('backend/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('backend/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('backend/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">

@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
    </div>
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
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Data Kategori Destinasi Wisata</h2>
            <div class="clearfix"></div>
          </div>
          <a href="{{url('admin/kategori/tambah-kategori')}}" class="btn btn-primary">Tambah Data Kategori</a>
          <div class="x_content">
            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th width="25px"><center>No</center></th>
                  <th><center>Nama Kategori</center></th>
                  <th><center>Marker</center></th>
                  <th><center>ID User</center></td>
                  <th><center>Tanggal</center></th>
                  <th><center>Opsi</center></th>
                </tr>
              </thead>
              <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($categories as $kategori)
                    <tr>
                        <td><center> {{$no++}} </center></td>
                        <td><center> {{$kategori->kategori}} </center></td>
                        <td><center> 
                            <img src="{{asset('backend/images/marker/'.$kategori->marker)}}" class="img-responsive">
                         </center></td>
                        <td><center> {{$kategori->user->nama}} </center></td>
                        <td><center> {{$kategori->created_at->format('d-m-Y')}} </center></td>
                        <td><center>
                            <a href="{{url('admin/kategori/'.$kategori->id.'/edit-kategori')}}" class="fa fa-pencil"></a>
                            {{--  <a href="javascript:void(0)" class="fa fa-pencil" onclick="editModal('{{json_encode($periode)}}')"></a>  --}}
                            <a href="javascript:void(0)" class="fa fa-trash" onclick="deleteKategori('{{$kategori->id}}')"></a>
                        </center></td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<form class="hidden" action="" method="post" id="formDelete">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="delete">
</form>
<!-- /page content -->
@endsection

@section('js')
    <script src="{{asset('backend/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
   

    <script src="{{asset('backend/plugins/bootbox.min.js')}}"></script>
    <script type="text/javascript">

    function deleteKategori(id){
        bootbox.confirm("Apakah anda ingin menghapus data ini ?", function(result){
            if (result) {
                $('#formDelete').attr('action', '{{url('admin/kategori/data-kategori')}}/'+id);
                $('#formDelete').submit();
            }
        });
    }
    </script>
@endsection