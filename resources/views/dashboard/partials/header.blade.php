<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>

<link href="{{ asset('backend-assets/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend-assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

<!-- Toastr style -->
<link href="{{ asset('backend-assets/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">

<!-- Gritter -->
<link href="{{ asset('backend-assets/js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet">

<link href="{{ asset('backend-assets/css/animate.css') }}" rel="stylesheet">
<link href="{{ asset('backend-assets/css/style.css') }}" rel="stylesheet">

<style type="text/css">
	.progress{
		background-color: #d2d2d2 !important;
	}
</style>

{{-- larvel Toastr --}}
{{-- @toastr_css --}}
