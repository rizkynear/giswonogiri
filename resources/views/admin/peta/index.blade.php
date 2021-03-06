<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal">Peta Lokasi Wisata</h5>
        <form action="{{ url('admin/peta/search') }}" method="GET" class="form-inline">
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
                <a class="dropdown-item" href="{{ url('admin/peta') }}">Semua Kategori</a>
                @foreach ($categories as $cat)
                <a class="dropdown-item" href="{{ url('admin/peta/kategori/'.$cat->id) }}">{{ $cat->kategori }}</a>
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
        <!-- @foreach ($wisata as $wis)
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
            @endforeach -->
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
        
        var pos;
        var latit;
        var longit;
        var markers = [];

        function myMap() {
            //mendefinisikan maps
            var mapProp = {
                //memberi kordinat yang akan d tampilkan dengan google.maps.LatLng(-8.655752, 115.215514)
                //menentukan level zoom
                //center: new google.maps.LatLng(-7.9617685, 110.8966327),
                center: new google.maps.LatLng(-7.7999592, 110.8801831),
                zoom: 10,
                mapTypeId: 'roadmap',
            };
            var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

            var directionsService = new google.maps.DirectionsService;
            var directionsDisplay = new google.maps.DirectionsRenderer;

            directionsDisplay.setMap(map);

            wisata.forEach(function(wisata) {
                var coordinates = {
                    lat: parseFloat(wisata.lat),
                    lng: parseFloat(wisata.long)
                }
                addMarker(coordinates, wisata);
            })



            function addMarker(coordinates, wisata) {
                var path = '/backend/images/marker/';

                var myLoc = new google.maps.Marker({
                    clickable: false,
                    icon: new google.maps.MarkerImage('//maps.gstatic.com/mapfiles/mobile/mobileimgs2.png',
                        new google.maps.Size(22, 22),
                        new google.maps.Point(0, 18),
                        new google.maps.Point(11, 11)),
                    shadow: null,
                    zIndex: 999,
                    map: map,
                });


                var contentString = 
                    '<div id="content">' +
                    '<div id="top-content">' +
                    '<p><i class="fa fa-file-text-o"></i> Informasi Wisata</p>' +
                    '</div>' +
                    '<div id="img">' +
                    '<img src="{{ asset('backend/images/fotowisata') }}' + '/' + wisata.foto + '">' +
                    '</div>' +
                    '<div id="bodyContent">' +
                    '<div class="clearfix">' +
                    '<div class="containerContent">' +
                    '<div class="bodyContentLeft">' +
                    '<p>Nama Wisata :</p>' +
                    '</div>' +
                    '<div class="bodyContentRight">' +
                    '<p>' + wisata.nama + '</p>' +
                    '</div>' +
                    '</div>' +
                    '<div class="containerContent">' +
                    '<div class="bodyContentLeft">' +
                    '<p>Kategori Wisata :</p>' +
                    '</div>' +
                    '<div class="bodyContentRight">' +
                    '<p>' + wisata.category.kategori + '</p>' +
                    '</div>' +
                    '</div>' +
                    '<div class="containerContent long">' +
                    '<div class="bodyContentLeft">' +
                    '<p>Alamat Wisata :</p>' +
                    '</div>' +
                    '<div class="bodyContentRight">' +
                    '<p>' + wisata.alamat + '</p>' +
                    '</div>' +
                    '</div>' +
                    '<div class="containerContent long">' +
                    '<div class="bodyContentLeft">' +
                    '<p>Deskripsi Wisata :</p>' +
                    '</div>' +
                    '<div class="bodyContentRight">' +
                    '<p>' + wisata.keterangan + '</p>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';

                var contentWindow = new google.maps.InfoWindow({
                    content: contentString
                });

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
                    map: map,
                    infowindow: contentWindow
                });
                marker.setMap(map);

                markers.push(marker);

                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };

                        var me = new google.maps.LatLng(pos);

                        myLoc.setPosition(me);
                    }, function() {
                        handleLocationError(true, infoWindow, map.getCenter());
                    });
                } else {
                    // Browser doesn't support Geolocation
                    handleLocationError(false, infoWindow, map.getCenter());
                }

                var lastWindow = null;

                google.maps.event.addListener(marker, 'click', function() {
                    hideAllInfoWindows(map);
                    this.infowindow.open(map, this);

                    latit = marker.getPosition().lat();
                    longit = marker.getPosition().lng();
                });

                marker.addListener('click', function() {
                    directionsService.route({
                        origin: pos,
                        destination: {
                            lat: latit,
                            lng: longit
                        },
                        travelMode: 'DRIVING'
                    }, function(response, status) {
                        if (status === 'OK') {
                            directionsDisplay.setDirections(response);
                        } else {
                            window.alert('Directions request failed due to ' + status);
                        }
                    });
                });

            }
        }

        
        function hideAllInfoWindows(map) {
            markers.forEach(function(marker) {
                marker.infowindow.close(map, marker);
            }); 
        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesn\'t support geolocation.');
            infoWindow.open(map);
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRt2sZGA36bo9UG78KLWo-v1LpUdqxxMA&callback=myMap" type="text/javascript"></script>
</body>

</html>