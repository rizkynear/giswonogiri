@extends('layouts.master')

@section('css')

@endsection

@section('content')
<div class="right_col" role="main">
  <div class="row tile_count">
  </div>
  <br />
  <div class="alert alert-success" role="alert">
	  <h3 class="alert-heading">Selamat Datang {{ Auth::user()->name }}!</h3>
	  <p>Selamat datang di halaman Admin Sistem Informasi Geografis Destinasi Wisata Kabupaten Wonogiri</p>
	  <hr>
	  <p class="mb-0">Mohon untuk menggunakan Sistem ini sebaik-baiknya agar menciptakan kenyamanan bersama</p>
	</div>
	<div class="clearfix"></div>
</div>
@endsection