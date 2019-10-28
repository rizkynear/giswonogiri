<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Page</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('backend/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <link href="{{asset('backend/vendors/animate.css/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/build/css/custom.min.css')}}" rel="stylesheet">
  </head>
  <body class="login">
    <div>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <div class="box">
            <div class="box-body">
              <section class="login_content">
              <form action="{{url('login')}}" method="POST">
              {{ csrf_field() }}
                <h1>SIG Destinasi Wisata Wonogiri</h1>
                <div>
                  <input type="email" name="email" class="form-control" placeholder="Email" required="" />
                </div>
                <div>
                  <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                </div>
                <div>
                  <button type="submit" class="btn btn-primary btn-block">Login</button>
                </div>

                <div class="clearfix"></div>
              </form>
              </section>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
