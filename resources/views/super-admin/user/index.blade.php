@extends('layouts.master')

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
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
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Profile</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
              <div class="profile_img">
                <div id="crop-avatar">
                  <!-- Current avatar -->
                  <img class="img-responsive avatar-view" src="{{asset('backend/images/fotoprofil/'.$users->foto)}}" alt="Avatar" title="Change the avatar">
                </div>
              </div>
              <h3></h3>

              <ul class="list-unstyled user_data">
                <li><i class="fa fa-user user-profile-icon"></i> {{$users->nama}}
                </li>

                <li>
                  <i class="fa fa-briefcase user-profile-icon"></i> {{$users->email}}
                </li>

              </ul>
              <br />
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">

              <div class="profile_title">
                <div class="col-md-12">
                  <h2>Ubah Data Profile</h2>
                  <form action="{{url('admin/user/data-user/'.$users->id.'/edit-user')}}" method="POST" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <input type="hidden" name="_method" value="put">
                      <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" value="{{$users->nama}}">
                      </div>
                      <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" value="{{$users->email}}">
                      </div>
                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" value="{{$users->username}}">
                      </div>
                      <div class="form-group">
                        <label>Password</label>
                        <input type="text" class="form-control" name="password">
                        <small>Kosongkan jika tidak ingin mengubah password</small>
                      </div>
                      <div class="form-group">
                        <label>Foto Profil</label>
                        <input type="file" class="form-control" name="foto" value="">
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>Simpan Perubahan</button>
                      </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection