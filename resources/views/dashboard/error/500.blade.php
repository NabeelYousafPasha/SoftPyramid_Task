<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>OEPS | UIIT | 500-Error</title>

    <!-- Faviocn -->
    <link rel="shortcut icon" href="{{ asset('backend-assets/aaur.png')}}" />

    <link href="{{ asset('backend-assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend-assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ asset('backend-assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('backend-assets/css/style.css') }}" rel="stylesheet">

</head>

<body class="gray-bg">


    <div class="middle-box text-center animated fadeInDown">
        <h1>500</h1>
        <h3 class="font-bold">Internal Server Error</h3>

        <div class="error-desc">
            The server encountered something unexpected that didn't allow it to complete the request. We apologize.<br/>
            You can go back to main page: <br/><a href="{{ '/' }}" class="btn btn-primary m-t">OEPS - Dashboard</a>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('backend-assets/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('backend-assets/js/bootstrap.min.js') }}"></script>

</body>

</html>