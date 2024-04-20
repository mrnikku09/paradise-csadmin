@php
    $user = Session::get('CS_USER');
    $settingData = App\Models\CsThemeAdmin::where('id', 1)->first();
@endphp
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8">
    <title>Admin - @if (isset($title) && $title != '')
        {{ $title }} @endif</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
   <!-- Favicon -->
   <link href="{{ env('SETTING_IMAGE') }}{{ $settingData->favicon }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('public/backend_assets/assets/lib/owlcarousel/assets/owl.carousel.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('public/backend_assets/assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}"
        rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('public/backend_assets/assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('public/backend_assets/assets/css/style.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body>
    @yield('content')
    <!-- end auth-page-wrapper -->

   <!-- JavaScript Libraries -->
    <script src="{{ asset('backend_assets/assets/plugins/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('public/backend_assets/assets/https://code.jquery.com/jquery-3.4.1.min.js') }}"></script>
    <script
        src="{{ asset('public/backend_assets/assets/https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js') }}">
    </script>
    <script src="{{ asset('public/backend_assets/assets/lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('public/backend_assets/assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('public/backend_assets/assets/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('public/backend_assets/assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('public/backend_assets/assets/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('public/backend_assets/assets/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('public/backend_assets/assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}">
        <script src="https://cdn.ckeditor.com/4.12.1/full-all/ckeditor.js"></script>

        <script type="text/javascript">
        CKEDITOR.replace(".ckeditor");
        CKEDITOR.config.allowedContent = true;
    </script>
    </script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
