<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
            <h5 class="my-0 mr-md-auto font-weight-normal">Peta Lokasi Wisata</h5>
            <form action="{{ url('admin/peta/peta/search') }}" method="GET" class="form-inline">
                <input type="text" name="keyword" class="form-control mr-2" id="search" placeholder="Input Kata Kunci">
                <button type="submit" class="btn btn-secondary mr-2">
                    Cari
                </button>
            </form>
            <nav class="my-2 my-md-0 mr-md-3">
                <button class="btn btn-success dropdown-toggle mr-2" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @php
                        if (!isset($catName)) {
                            $catName = '';
                        }
                    @endphp
                    {{ $catName == '' ? 'Pilih Kategori' : $catName }}
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ url('admin/peta/peta') }}">Semua Kategori</a>
                    @foreach ($categories as $cat)
                        <a class="dropdown-item" href="{{ url('admin/peta/peta/kategori/'.$cat->id) }}">{{ $cat->kategori }}</a>
                    @endforeach
                </div>
                <a class="btn btn-danger" type="button" href="{{ url('admin/dashboard') }}">
                    Dashboard
                </a>
            </nav>
        </div>
        <!-- mengatur tampilan maps dengan id div=googlemap -->
        <div class="container-fluid">
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
            <div id="googleMap" style="width:100%;height:100vh;"></div>
            
            <!-- Modal -->
            @foreach ($wisata as $wis)
                <div class="modal fade" id="{{ $wis->id }}modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Info Wisata</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body d-flex justify-content-center align-item-center">
                            <div class="card" style="width: 100%">
                            <img class="card-img-top" src="{{ asset('backend/images/fotowisata/'.$wis->foto) }}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $wis->nama }}</h5>
                                    <p class="card-text">{{ $wis->keterangan }}</p>
                                    <p class="card-text"><small class="text-muted">{{ $wis->alamat }}</small></p>
                                    <p class="card-text"><small class="text-muted">Telepon : {{ $wis->no_telp }}</small></p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    </div>
                </div>
            @endforeach
        </div>
            <script src="{{ asset('js/app.js') }}"></script>
            <!--
            <br>
            <h1>MAP 2</h1>
            <div id="googleMap2" style="width:50%;height:400px;"></div>
            <br>
            <h1>MAP 3</h1>
            <div id="googleMap3" style="width:50%;height:400px;"></div>
            <br>
            <h1>MAP4</h1>
            <div id="googleMap4" style="width:50%;height:400px;"></div>
            <br>
            <h1>MAP 5</h1>
            <div id="googleMap5" style="width:50%;height:400px;"></div>
            -->
                <script>
                    var wisata = {!! json_encode($wisata->toArray()) !!}
                    // console.log(wisata)
                    
                    function myMap() {
                        //mendefinisikan maps
                        var mapProp= {
                            //memberi kordinat yang akan d tampilkan dengan google.maps.LatLng(-8.655752, 115.215514)
                            //menentukan level zoom
                            //center: new google.maps.LatLng(-7.9617685, 110.8966327),
                            center: new google.maps.LatLng(-7.7999592,110.8801831),
                            zoom: 10,
                            //mendisable tombol default pada maps
                            disableDefaultUI: false
                        };
                        var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

                        wisata.forEach(function(wisata) {
                            var coordinates = {lat: parseFloat(wisata.lat), lng: parseFloat(wisata.long)}
                            addMarker(coordinates, wisata)
                        })
                        
                        function addMarker(coordinates, wisata) {
                            var path = '/backend/images/marker/';
                            var marker = new google.maps.Marker({
                                position: coordinates,
                                icon: {
                                    url: path + wisata.category.marker,
                                    labelOrigin: new google.maps.Point(25, -7)
                                },
                                label: {
                                    color: 'black',
                                    fontWeight: 'bold',
                                    text: wisata.nama
                                },
                            });
                            marker.setMap(map);

                            google.maps.event.addListener(marker, 'click', function () {
                                $('#'+wisata.id+'modal').modal('show')
                            })
                        }
                    }

                        

                        // memanggil fungsi addMarker
                        // addMarker(markerCenter);
  /*                      
                        var markerCenter = new google.maps.LatLng(-8.656067, 115.217810);
                        var marker = new google.maps.Marker({
                            position:markerCenter,
                            icon:'image/airport.png',
                            draggable:true
                            });
                        marker.setMap(map);

                        //Menampilkan info window ketika di klik
                        google.maps.event.addListener(marker,'click',function() {
                        var infowindow = new google.maps.InfoWindow({
                            content: "Kantor Walikota!"
                        });
                        //menampilkan info windows
                        infowindow.open(map,marker);
                        //atur waktu untuk menutup info windows (2 detik)
                        window.setTimeout(function() {infowindow.close(map,marker);},2000);
                        });
                        
                        //double click untuk unZoom
                        google.maps.event.addListener(marker,'dblclick',function() {
                                
                                    map.setZoom(15);
                                    map.setCenter(marker.getPosition());
                                
                        });

                        google.maps.event.addListener(marker,'click',function() {
                            //mendapatkan zoom awal
                            var pos = map.getZoom();
                            //setelah di klik, zoom akan berubah sesuai nilai yang di berikan map.setZoom(20);
                            map.setZoom(20);
                            map.setCenter(marker.getPosition());
                            //atur waktu untuk zoom kembali ke semula (2 detik)
                            //window.setTimeout(function() {map.setZoom(pos);},2000);
                        });
                        
                        //Klik pada peta untuk memberi marker, dan menampilkan info latitude dan longtitude
                        google.maps.event.addListener(map, 'click', function(event) {
                            placeMarker(map, event.latLng);
                        });
                        }
                        
                        //fungsi untuk memberi marker
                        function placeMarker(map, location) {
                        var marker = new google.maps.Marker({
                            position: location,
                            map: map,
                            icon:'image/airport.png',
                            draggable:true
                        });
                        //menampilkan infowindow 
                        var infowindow = new google.maps.InfoWindow({
                            content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
                        });
                        infowindow.open(map,marker);
                        
                        //DRAG MARKER
                        google.maps.event.addListener(tanda, 'dragend', function(event){
                            var infowindow = new google.maps.InfoWindow({
                            content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
                        });
                        infowindow.close(map,marker);
                        infowindow.open(map,marker);
                        });
*/
                        /*
                        //untuk membuat marker lebih dari 1
                        var markerCenter2 = new google.maps.LatLng(-8.655363, 115.212560);
                        var marker2 = new google.maps.Marker({position:markerCenter2});
                        marker2.setMap(map);

                        var markerCenter3 = new google.maps.LatLng(-8.655915, 115.216176);
                        var marker3 = new google.maps.Marker({position:markerCenter3});
                        marker3.setMap(map);
                        */
                    
                    /*

                    //untuk membuat peta lebih dari 1
                    var mapProp2= {
                        center:new google.maps.LatLng(-8.655752, 115.215514),
                        zoom:15,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    };
                    var map2=new google.maps.Map(document.getElementById("googleMap2"),mapProp2);
                    

                    
                    var mapProp3= {
                        center:new google.maps.LatLng(-8.655752, 115.215514),
                        zoom:15,
                        mapTypeId: google.maps.MapTypeId.SATELLITE
                    };
                    var map3=new google.maps.Map(document.getElementById("googleMap3"),mapProp3);
                    

                    
                    var mapProp4= {
                        center:new google.maps.LatLng(-8.655752, 115.215514),
                        zoom:15,
                        mapTypeId: google.maps.MapTypeId.HYBRID
                    };
                    var map4=new google.maps.Map(document.getElementById("googleMap4"),mapProp4);
                    

                    
                    var mapProp5= {
                        center:new google.maps.LatLng(-8.655752, 115.215514),
                        zoom:15,
                        mapTypeId: google.maps.MapTypeId.TERRAIN
                    };
                    var map5=new google.maps.Map(document.getElementById("googleMap5"),mapProp5);
                    */
                    // }
                </script>
                <!-- 
                    Variabel mapProp mendefinisikan properties untuk map.
                        - center property digunakan untuk menentukan pusat dari maps yang akan di tampilkan (menggunakan latitude and longitude coordinates).
                        - zoom property untuk menentukan zoom level dari map
                    baris ini: var map=new google.maps.Map(document.getElementById("googleMap"), mapProp);
                    digunakan untuk membuat maps di dalam <div> elemen dengan id="googleMap"
                    menggunakan parameter yang di kirimkan oleh (mapProp). 
                -->

                <!-- 
                    MEMBUAT MULTI MAPS
                    var map1 = new google.maps.Map(document.getElementById("googleMap1"), mapOptions1);
                    var map2 = new google.maps.Map(document.getElementById("googleMap2"), mapOptions2);
                    var map3 = new google.maps.Map(document.getElementById("googleMap3"), mapOptions3);
                    var map4 = new google.maps.Map(document.getElementById("googleMap4"), mapOptions4);
                 -->

                 <!-- 
                    MEMBUAT MARKERS
                    1. MENAMBAHKAN MARKER
                        menggunakan method marker.setMap();

                        var markerCenter = new google.maps.LatLng(-8.656067, 115.217810);
                        var marker = new google.maps.Marker({position:markerCenter});
                        marker.setMap(map);

                    2. MENAMBAHKAN ANIMASI PADA MARKER
                        animation: google.maps.Animation.BOUNCE

                        var markerCenter = new google.maps.LatLng(-8.656067, 115.217810);
                        var marker = new google.maps.Marker({position:markerCenter,animation: google.maps.Animation.BOUNCE});
                        marker.setMap(map);

                    3. MENAMBAHKAN ICON
                        Menambah icon pada marker
                        
                        var marker=new google.maps.Marker({
                            position:myCenter,
                            icon:'pinkball.png' //lokasi file gambar
                            });

                            marker.setMap(map);
                    4. Menambahkan Info Window
                        Menambahkan Informasi singkat saat marker di klik
                        var infowindow = new google.maps.InfoWindow({
                            content: "Hello World!"
                        });
                        infowindow.open(map,marker);
                 -->
                 <!-- 
                    MENAMBAHKAN EVENT
                    google.maps.event.addListener(marker,'click',function(){})
                    1. ZOOM SAAT DI KLIK
                        google.maps.event.addListener(marker,'click',function() {
                                map.setZoom(9);
                                map.setCenter(marker.getPosition());
                        });

                    2. MENAMPILKAN INFO WINDOWS KETIKA DI KLIK
                        google.maps.event.addListener(marker,'click',function() {
                            var infowindow = new google.maps.InfoWindow({
                            content:"Hello World!"
                            });
                        infowindow.open(map,marker);
                        });

                    3. MENENTUKAN LETAK MARKER DAN MENAMPILKAN INFO
                        placeMarker()

                        google.maps.event.addListener(map, 'click', function(event) {
                            placeMarker(map, event.latLng);
                        });
                        }

                        function placeMarker(map, location) {
                        var marker = new google.maps.Marker({
                            position: location,
                            map: map
                        });
                        var infowindow = new google.maps.InfoWindow({
                            content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
                        });
                        infowindow.open(map,marker);
                  -->
                  <!-- 
                      MAPS CONTROL
                      1. MENGHILANGKAN DEFAULT CONTROL PADA TAMPILAN MAPS
                        disableDefaultUI: true
                   -->
                <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAobFIZz9uFEG7zrFVU4W3r7XIIZ9dZeME&callback=myMap" type="text/javascript"></script>
    </body>
</html>