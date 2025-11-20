<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') | Admin</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('purple/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('purple/assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('purple/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('purple/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('purple/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('purple/assets/css/style.css') }}">

    <link rel="shortcut icon" href="{{ asset('purple/assets/images/favicon.png') }}" />
</head>

<body>
    <div class="container-scroller">

        {{-- NAVBAR --}}
        @include('admin.layouts.navbar')

        <div class="container-fluid page-body-wrapper">

            {{-- SIDEBAR --}}
            @include('admin.layouts.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>

                {{-- FOOTER --}}
                @include('admin.layouts.footer')

            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="{{ asset('purple/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('purple/assets/vendors/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('purple/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

    <script src="{{ asset('purple/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('purple/assets/js/misc.js') }}"></script>
    <script src="{{ asset('purple/assets/js/settings.js') }}"></script>
    <script src="{{ asset('purple/assets/js/todolist.js') }}"></script>
    <script src="{{ asset('purple/assets/js/jquery.cookie.js') }}"></script>

    @stack('scripts')
</body>

</html>
