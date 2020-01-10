<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sig Wonogiri - Peta</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- manual style -->
    <link href=" {{asset('backend/vendors/font-awesome/font-awesome/css/font-awesome.min.css')}} " rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style_for_maps.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>  
    
    <main>
        <section>
            <div class="bg-board">
                <div id="googleMap" style="width:100%;height:100vh;"></div>
                <div class="page-header over-map" style="width: 100%; padding: 5px 50px;">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="logo">
                                Sig Wonogiri                                    
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <form id="form-search">
                                <div class="group-input">
                                    <input type="text" class="form-control" name="search" placeholder="Search for...">
                                    <button class="category" style="display: none" type="button">search</button>
                                    <button class="btn btn-success btn-search clear" type="button"><i class="fa fa-check"></i></button>
                                    <button class="btn btn-default btn-search" id="close" type="button"><i class="fa fa-list-ul"></i></button>
                                    <button class="btn btn-default btn-search" id="show" type="button" style="display: none;"><i class="fa fa-list-ul"></i></button>
                                    <a href="{{ route('home') }}" class="btn btn-danger"><i class="fa fa-sign-out"></i></a>
                                </div><!-- /input-group -->
                            </form>
                        </div>
                    </div>
                </div>
                <div class="content-list over-map fr" style="width: 30%; top: 125px">
                    <div class="list-board">
                        <div class="over-flow">
                            <ul class="list-group">
                                <li class="list-group-item list-group-item-info header">Kategori</li>
                                <li class="list-group-item"><input type="radio" name="id" class="category" value="all"> Semua Kategori</li>
                                @foreach ($categories as $category)
                                    <li class="list-group-item"><input type="radio" name="id" class="category" value="{{ $category->id }}"> {{ $category->kategori }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <form action="{{ route('home.peta.search') }}" method="get" id="form-search">
        <input type="hidden" name="id" id="kategori-id">
    </form>

    <!-- Latest compiled and minified JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script>
        var wisata = {!! json_encode($wisatas->toArray()) !!};

        // $('.category').click(function() {
        //     var value = $("input[name='id']:checked").val();

        //     $('#kategori-id').attr('value', value);
        //     $('#form-search').submit();
        // });


        var pos;
        var latit;
        var longit;
        var destination = [];
        var markers = [];
        var direc = [];

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

            var directionsDisplay = new google.maps.DirectionsRenderer;
            var directionsService = new google.maps.DirectionsService;

            directionsDisplay.setMap(map);

            direc = [];
            direc.push(directionsDisplay, directionsService);

            $('#form-search').on('keyup keypress', function(e) {
                var keyCode = e.keyCode || e.which;
                
                if (keyCode === 13) { 
                    e.preventDefault();

                    $('button.category').trigger('click');
                }
            });

            $('.clear').click(function() {
                directionsDisplay.setMap(null);
                hideAllInfoWindows(map);
                reloadMarkers();
                $("input[name='id']").prop('checked', false);
            });

            $('.category').click(function() {
                var value  = $("input[name='id']:checked").val();
                var search = $("input[name='search']").val();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('home.peta.search') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: value,
                        search: search
                    },
                    success: function(callback) {
                        reloadMarkers();

                        $.each(callback.wisatas, function(key, wisata) {
                            var coordinates = {
                                lat: parseFloat(wisata.lat),
                                lng: parseFloat(wisata.long)
                            }

                            addMarker(coordinates, wisata);
                        })
                    }
                });
            });

            function reloadMarkers() {
                for (var i = 0; i < markers.length; i++) {
                    markers[i].setMap(null);
                }
                
                markers = [];
            }

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
                    '<button class="btn btn-50 btn-primary" onclick="setDirection()">Rute </button>' +
                    '<a class="btn btn-primary btn-50" href="https://www.google.com/maps/search/?api=1&query=' + coordinates.lat + ',' + coordinates.lng + '" target="_blank">Navigasi</a>'+
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
                    map.setCenter(marker.getPosition());

                    destination = [];

                    destination.push(marker.getPosition().lat(), marker.getPosition().lng());
                });

            }
        }
        
        function setDirection() {
            var directionsDisplay = direc[0];
            var directionsService = direc[1];

            directionsService.route({
                origin: pos,
                destination: {
                    lat: destination[0],
                    lng: destination[1]
                },
                travelMode: 'DRIVING'
            }, function(response, status) {
                if (status === 'OK') {
                    directionsDisplay.setDirections(response);
                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            });
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

        $('#close').click(function(e) {
            e.preventDefault();

            $('.list-board').hide()
            $(this).hide();
            $('#show').show();
        });

        $('#show').click(function(e) {
            e.preventDefault();

            $('.list-board').show()
            $(this).hide();
            $('#close').show();
        });
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRt2sZGA36bo9UG78KLWo-v1LpUdqxxMA&callback=myMap" type="text/javascript"></script>
</body>
</html>