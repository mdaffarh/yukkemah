<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        @if (View::hasSection('title'))
            Yuk! Kemah - @yield('title')
        @else
            Yuk! Kemah
        @endif
    </title>

    {{-- custom css --}}
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    {{-- icon --}}
    <link rel="shortcut icon" href="{{ asset('img/icon.ico') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('dashboard-assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
</head>

<body class="bg-gradient-warning">
    @include('sweetalert::alert')
    @yield('container')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>
