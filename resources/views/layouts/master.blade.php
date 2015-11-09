<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Aptimyze</title>
	<link rel="stylesheet" href="{{asset('/assets/css/vendor/bootstrap-3.3.5.min.css')}}">
	<link rel="stylesheet" href="{{asset('/assets/css/vendor/font-awesome-4.4.0.min.css')}}">
	<link rel="stylesheet" href="{{asset('/assets/css/vendor/bootstrapValidator-0.5.3.min.css')}}">
	<link rel="stylesheet" href="{{asset('/assets/css/vendor/rickshaw.min.css')}}">
	{{-- Custom stylesheet --}}
	<link rel="stylesheet" href="{{asset('/assets/css/style.css')}}">
</head>
<body>

	@include('templates.header')

	<div class="container">
        @include('templates.message')
        @yield('content')
	</div>

	<hr/>

	@include('templates.footer')
	<!-- Scripts -->
	<script src="{{asset('/assets/js/vendor/jquery-1.10.2.min.js')}}"></script>
	<script src="{{asset('/assets/js/vendor/bootstrap-3.3.5.min.js')}}"></script>
	<script src="{{asset('/assets/js/vendor/bootstrapValidator-0.5.3.min.js')}}"></script>
	<script src="{{asset('/assets/js/vendor/d3.v2.min.js')}}"></script>
	<script src="{{asset('/assets/js/vendor/d3.layout.min.js')}}"></script>
	<script src="{{asset('/assets/js/vendor/rickshaw.min.js')}}"></script>
	@yield('pagejquery')
</body>
</html>
