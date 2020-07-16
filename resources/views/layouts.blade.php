<!DOCTYPE html>
<!-- saved from url=(0043)home-twocolumn.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Bootstrap 4 Magazine/Blog Theme">
    <meta name="author" content="Bootlab">

    <title> @yield('title')</title>
    <link href="{{ asset('assets/frontend/app.css')}}" rel="stylesheet">
</head>
<body>

  @include('Frontend/header')

    <main class="main pt-4">

        <div class="container">

            <div class="row">
                <div class="col-md-9">

                    <div class="row">
                        
                         @yield('content')
                      
                    </div>

                </div>

                  @include('Frontend/sidebar')

            </div>
        </div>

    </main>
  @include('Frontend/footer')

    <script src="{{ asset('assets/frontend/app.js')}}"></script>


</body>
</html>