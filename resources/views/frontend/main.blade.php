<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nego | Platform</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('organi-asset/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('organi-asset/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('organi-asset/css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('organi-asset/css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('organi-asset/css/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('organi-asset/css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('organi-asset/css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('organi-asset/css/style.css')}}" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
   
    <!-- Header Section End -->
        @yield('navbar')
    <!-- Hero Section Begin -->
    
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->
        @yield('hero')
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
   
    <!-- Featured Section End -->

    <!-- Banner Begin -->
   <!--  <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Banner End -->

    <!-- Latest Product Section Begin -->
        @yield('content')
    <!-- Latest Product Section End -->

    <!-- Blog Section Begin -->
    @yield('blog')
    <!-- Blog Section End -->

    <!-- Footer Section Begin -->
        @yield('footer')
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{asset('organi-asset/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('organi-asset/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('organi-asset/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('organi-asset/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('organi-asset/js/jquery.slicknav.js')}}"></script>
    <script src="{{asset('organi-asset/js/mixitup.min.js')}}"></script>
    <script src="{{asset('organi-asset/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('organi-asset/js/main.js')}}"></script>
    
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-migrate-3.3.2.js" integrity="sha256-BDmtN+79VRrkfamzD16UnAoJP8zMitAz093tvZATdiE=" crossorigin="anonymous"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    @yield('script')



</body>

</html>