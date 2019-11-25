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
            <h2>Data Admin</h2>
            <div class="clearfix"></div>
          </div>
          <a href="{{url('super-admin/admin/tambah-admin')}}" class="btn btn-primary">Tambah Admin</a>
          <div class="x_content">
            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th width="25px"><center>No</center></th>
                  <th><center>Nama</center></th>
                  <th><center>Username</center></th>
                  <th><center>Email</center></td>
                  <th><center>Foto</center></th>
                  <th><center>Status</center></th>
                  <th><center>Tanggal Dibuat</center></th>
                  <th><center>Opsi</center></th>
                </tr>
              </thead>
              <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($admins as $admin)
                  @if(! $admin->trashed())
                    <tr>
                        <td><center> {{$no++}} </center></td>
                        <td><center> {{$admin->nama}} </center></td>
                        <td><center> {{$admin->username}} </center></td>
                        <td><center> {{$admin->email}} </center></td>
                        <td><center> 
                            <img src="{{asset('backend/images/fotoprofil/'.$admin->foto)}}" class="img-responsive">
                         </center></td>
                        <td><center> Aktif </center></td>
                        <td><center> {{ isset($admin->created_at) ? $admin->created_at->format('d-m-Y') : '-' }} </center></td>
                        <td><center>
                            <a href="javascript:void(0)" class="fa fa-trash" onclick="deleteAdmin('{{$admin->id}}')"></a>
                        </center></td>
                    </tr>
                  @else
                  <tr>
                        <td><center> {{$no++}} </center></td>
                        <td><center> {{$admin->nama}} </center></td>
                        <td><center> {{$admin->username}} </center></td>
                        <td><center> {{$admin->email}} </center></td>
                        <td><center> 
                            <img src="{{asset('backend/images/fotoprofil/'.$admin->foto)}}" class="img-responsive">
                         </center></td>
                        <td><center> Tidak Aktif </center></td>
                        <td><center> {{ isset($admin->created_at) ? $admin->created_at->format('d-m-Y') : '-' }} </center></td>
                        <td><center>
                            <a href="javascript:void(0)" class="fa fa-repeat" onclick="restoreAdmin('{{$admin->id}}')"></a>
                        </center></td>
                    </tr>
                  @endif
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

<form class="hidden" action="" method="post" id="formRestore">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="put">
</form>
<!-- /page content -->
@endsection

@section('js')
    <script src="{{asset('backend/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
   

    <script src="{{asset('backend/plugins/bootbox.min.js')}}"></script>
    <script type="text/javascript">

    function deleteAdmin(id){
        bootbox.confirm("Apakah anda ingin menonaktifkan akun ini ?", function(result){
            if (result) {
                $('#formDelete').attr('action', '{{url("super-admin/admin/data-admin")}}/'+id);
                $('#formDelete').submit();
            }
        });
    }

    function restoreAdmin(id){
        bootbox.confirm("Apakah anda ingin mengaktifkan akun ini ?", function(result){
            if (result) {
                $('#formRestore').attr('action', '{{url("super-admin/admin/data-admin")}}/'+id);
                $('#formRestore').submit();
            }
        });
    }
    </script>
@endsection