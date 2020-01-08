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
                                <h1>Tambah Data Destinasi Wisata</h1>
                                <p>Silahkan masukkan data wisata</p>
                                
                            {{-- </div> --}}
                        </div>
                        <form role="form" action="{{url('admin/wisata/tambah-wisata')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            
                                <div class="clearfix" style="margin-top: 65px"></div>
                                <label>Nama Destinasi Wisata</label>
                                <input type="text" name="nama" class="form-control">
                                <br>
                                <label>Kategori</label>
                                <select class="form-control" name="id_kategori">
                                    @foreach ($categories as $kategori)
                                        <option value="{{$kategori->id}}">{{$kategori->kategori}}</option>
                                    @endforeach
                                </select>
                                <br>
                                <label>Alamat</label>
                                <input type="text" name="alamat" class="form-control">
                                <br>
                                <label>Telpon</label>
                                <input type="text" name="no_telp" class="form-control">
                                <br>
                                <div id="googleMap" style="width:100%;height:400px;"></div>
                                <label>Latitude</label>
                                <input type="text" id="latitude" name="lat" class="form-control" >
                                <br>
                                <label>Longitude</label>
                                <input type="text" id="longitude" name="long" class="form-control">
                                <br>
                                <label>Foto</label>
                                <input type="file" name="foto">
                                <br>
                                <label>Keterangan</label>
                                <textarea name="keterangan" class="form-control"></textarea>
                            
                            <br>
                            <br>
                            <br>
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

@section ('js')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAobFIZz9uFEG7zrFVU4W3r7XIIZ9dZeME"></script>
<script type="text/javascript">
    var peta;
	var gambar_tanda;
	gambar_tanda = '/backend/images/markers.png';
    var lokasibaru = new google.maps.LatLng(-7.7999592,110.8801831);
    //mendefinisikan maps
    var mapProp= {
    //memberi kordinat yang akan d tampilkan dengan google.maps.LatLng(-8.655752, 115.215514)
    //menentukan level zoom
    center:lokasibaru,
    zoom:15,
    //mendisable tombol default pada maps
    //disableDefaultUI: true
    };
    peta=new google.maps.Map(document.getElementById("googleMap"),mapProp);

    // ngasih fungsi marker buat generate koordinat latitude & longitude
	    tanda = new google.maps.Marker({
	        position: lokasibaru,
	        map: peta, 
	        icon: gambar_tanda,
	        draggable : true
	    });
	    
	    // ketika markernya didrag, koordinatnya langsung di selipin di textfield
	    google.maps.event.addListener(tanda, 'dragend', function(event){
				document.getElementById('latitude').value = this.getPosition().lat();
				document.getElementById('longitude').value = this.getPosition().lng();
		});

	function setpeta(x,y,id){
		// mengambil koordinat dari database
		var lokasibaru = new google.maps.LatLng(x, y);
		var petaoption = {
			zoom: 14,
			center: lokasibaru,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		
		peta = new google.maps.Map(document.getElementById("googleMap"),petaoption);
		 
		 // ngasih fungsi marker buat generate koordinat latitude & longitude
		tanda = new google.maps.Marker({
			position: lokasibaru,
			icon: gambar_tanda,
			draggable : true,
			map: peta
		});
		
		// ketika markernya didrag, koordinatnya langsung di selipin di textfield
		google.maps.event.addListener(tanda, 'dragend', function(event){
				document.getElementById('latitude').value = this.getPosition().lat();
				document.getElementById('longitude').value = this.getPosition().lng();
		});
    }                        
</script>
                        
@endsection