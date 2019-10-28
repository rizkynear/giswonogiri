<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container">
    <style media="screen">
                .nav-item{
                    margin-top: 5px;
                }
            </style>
                <ul class="nav nav-tabs"> 
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/')}}">SIG</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/peta')}}">Peta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{url('/about')}}">About Us</a>
                    </li>
                </ul>
                
            

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> -->
</body>
</html>
