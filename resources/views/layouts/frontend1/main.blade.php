<!DOCTYPE html>
<html>
    <head>

        <!-- /.website title -->
        <title>Auto Summary</title>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <!-- CSS Files -->
        <link href="{{asset('landing1/css/bootstrap.min.css')}}" rel="stylesheet" media="screen">
        <link href="{{asset('landing1/css/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{asset('landing1/fonts/icon-7-stroke/css/pe-icon-7-stroke.css')}}" rel="stylesheet">
        <link href="{{asset('landing1/css/animate.css')}}" rel="stylesheet" media="screen">
        <link href="{{asset('landing1/css/owl.theme.css')}}" rel="stylesheet">
        <link href="{{asset('landing1/css/owl.carousel.css')}}" rel="stylesheet">

        <!-- Colors -->
        <link href="{{asset('landing1/css/css-index.css')}}" rel="stylesheet" media="screen">
        <!-- <link href="css/css-index-green.css" rel="stylesheet" media="screen"> -->
        <!-- <link href="css/css-index-purple.css" rel="stylesheet" media="screen"> -->
        <!-- <link href="css/css-index-red.css" rel="stylesheet" media="screen"> -->
        <!-- <link href="css/css-index-orange.css" rel="stylesheet" media="screen"> -->
        <!-- <link href="css/css-index-yellow.css" rel="stylesheet" media="screen"> -->

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Google Fonts -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" />

    </head>

    <body data-spy="scroll" data-target="#navbar-scroll">

        <!-- /.preloader -->
        <div id="preloader"></div>
        <div id="top"></div>

        @yield('form_head')

        @include('layouts.frontend1.nav')

        @yield('content')

        

        <!-- /.footer -->
        <footer id="footer">
            <div class="container">
                <div class="col-sm-4 col-sm-offset-4">
                    <!-- /.social links -->
                    <div class="social text-center">
                        <ul>
                            <li><a class="wow fadeInUp" href="https://twitter.com/"><i class="fa fa-twitter"></i></a></li>
                            <li><a class="wow fadeInUp" href="https://www.facebook.com/" data-wow-delay="0.2s"><i class="fa fa-facebook"></i></a></li>
                            <li><a class="wow fadeInUp" href="https://plus.google.com/" data-wow-delay="0.4s"><i class="fa fa-google-plus"></i></a></li>
                            <li><a class="wow fadeInUp" href="https://instagram.com/" data-wow-delay="0.6s"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>	
                    <div class="text-center wow fadeInUp" style="font-size: 14px;">Copyright Backyard 2015 - Auto Report History  </div>
                    <a href="#" class="scrollToTop"><i class="pe-7s-up-arrow pe-va"></i></a>
                </div>	
            </div>	
        </footer>

        <!-- /.javascript files -->
        <script src="{{asset('landing1/js/jquery.js')}}"></script>
        <script src="{{asset('landing1/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('landing1/js/custom.js')}}"></script>
        <script src="{{asset('landing1/js/jquery.sticky.js')}}"></script>
        <script src="{{asset('landing1/js/wow.min.js')}}"></script>
        <script src="{{asset('landing1/js/owl.carousel.min.js')}}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script> --}}
        <script>
            new WOW().init();
        </script>
        @yield('js')
    </body>
</html>