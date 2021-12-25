<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Vehicle Data 3000</title>
	<!-- Favicon-->
	<link rel="icon" href="{{ asset('images/favicon/favicon.ico') }}" type="image/x-icon" >
	<link rel="icon" href="{{ asset('images/favicon/favicon-16x16.png') }}" type="image/png">

	<link href="{{asset('backend/asset/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('backend/asset/css/font-awesome.min.css')}}" rel="stylesheet">
	<link href="{{asset('backend/asset/css/datepicker3.css')}}" rel="stylesheet">
	{{-- <link href="{{asset('backend/asset/css/bootstrap-table.css')}}" rel="stylesheet"> --}}
	<link href="{{asset('backend/asset/css/styles.css')}}" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> --}}
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css" rel="stylesheet" />
</head>
<body>
	@include('layouts.backend.header1')
	@include('layouts.backend.nav1')
		
	@yield('content')
	
	{{-- <script src="{{asset('backend/asset/js/jquery-1.11.1.min.js')}}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="{{asset('backend/asset/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('backend/asset/js/chart.min.js')}}"></script>
	<script src="{{asset('backend/asset/js/chart-data.js')}}"></script>
	<script src="{{asset('backend/asset/js/easypiechart.js')}}"></script>
	<script src="{{asset('backend/asset/js/easypiechart-data.js')}}"></script>
	<script src="{{asset('backend/asset/js/bootstrap-datepicker.js')}}"></script>
	<script src="{{asset('backend/asset/js/custom.js')}}"></script>

    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script> --}}
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>

	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('js')
	<script>
        $( document ).ready(function() {
            var menu_active = '.menu-{{$menu_active}}';
            $(menu_active).addClass("active");
        });
    </script>
		
</body>
</html>