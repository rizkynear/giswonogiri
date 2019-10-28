<h1>Selamat Datang {{Auth::user()->username}}</h1>
<a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
    Logout Bro
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<div id="nama">
    <h2> Nama </h2>

    <?php if (!empty($nama)):?>
        <ul>
            <?php foreach($nama as $names):?>
                <li><?= $names ?> </li>
            <?php endforeach ?>
        </ul>
    <?php else : ?>
        <p>Tidak ada data</p>
    <?php endif ?>
</div>

<!DOCTYPE html>
<html>
    <body>
        <h1>My First Google Map</h1>
        <!-- mengatur tampilan maps dengan id div=googlemap -->
            <div id="googleMap" style="width:50%;height:400px;"></div>
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
                    function myMap() {
                        //mendefinisikan maps
                        var mapProp= {
                        //memberi kordinat yang akan d tampilkan dengan google.maps.LatLng(-8.655752, 115.215514)
                        //menentukan level zoom
                        center:new google.maps.LatLng(-8.655752, 115.215514),
                        zoom:15,
                        //mendisable tombol default pada maps
                        disableDefaultUI: true
                        };
                        var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
                        
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
                    }
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
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5AHP904uqVXHlKhMM7-TXB2825WQEx_A&callback=myMap"></script>
    </body>
</html>