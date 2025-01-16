<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Character encoding for the document -->
    <meta charset="UTF-8">

    <!-- Responsive meta tag for mobile-friendly design -->
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />

    <!-- CSRF token for securing AJAX requests in Laravel -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Page title displayed in the browser tab -->
    <title>FoodPark || Restaurant</title>

    <!-- Favicon icon for the browser tab -->
    <link rel="icon" type="image/png" href="frontend/images/favicon.png">

    <!-- Linking external CSS files for styling -->
    <link rel="stylesheet" href="{{ asset('frontend/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/venobox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.exzoom.css') }}">

    <!-- Toastr CSS for notifications -->
    <link rel="stylesheet" href="{{ asset('frontend/css/toastr.min.css') }}">

    <!-- Main and responsive stylesheet -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">

    <!-- RTL (Right to Left) stylesheet for languages like Arabic (Optional) -->
    <!-- <link rel="stylesheet" href="frontend/css/rtl.css"> -->
</head>

<body>
    {{-- @php
        Cart::destroy();
    @endphp --}}
    {{-- @dd(Cart::content()) --}}
    <div class="overlay-container d-none">
        <div class="overlay">
            <span class="loader"></span>
        </div>
    </div>
    <!--=============================
        TOPBAR AND MENU SECTION
    ==============================-->
    <!-- Includes the navigation menu from frontend.layouts.menu -->
    @include('frontend.layouts.menu')
    <!--======================   CART POPUT START  ======================-->
    @include('frontend.home.components.card_popput')
    <!--======================   CART POPUT END   ======================-->
    <!--=============================
        CONTENT SECTION
    ==============================-->
    <!-- This section dynamically displays the main content from different views -->
    @yield('content')

    <!--=============================
        FOOTER AND SCROLL BUTTON SECTION
    ==============================-->
    <!-- Includes the footer from frontend.layouts.footer -->
    @include('frontend.layouts.footer')

    <!--=============================
        JAVASCRIPT FILES
    ==============================-->

    <!-- jQuery library (core JS functionality) -->
    <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>

    <!-- Bootstrap JS for responsive design and components -->
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>

    <!-- FontAwesome icons -->
    <script src="{{ asset('frontend/js/Font-Awesome.js') }}"></script>

    <!-- Slick slider for carousel/slider functionality -->
    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>

    <!-- Isotope for filtering and layout masonry -->
    <script src="{{ asset('frontend/js/isotope.pkgd.min.js') }}"></script>

    <!-- Countdown timer functionality -->
    <script src="{{ asset('frontend/js/simplyCountdown.js') }}"></script>

    <!-- Counter Up for animating statistics -->
    <script src="{{ asset('frontend/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.countup.min.js') }}"></script>

    <!-- Nice select for styled dropdowns -->
    <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>

    <!-- Venobox for lightbox gallery popups -->
    <script src="{{ asset('frontend/js/venobox.min.js') }}"></script>

    <!-- Sticky sidebar for keeping content in view while scrolling -->
    <script src="{{ asset('frontend/js/sticky_sidebar.js') }}"></script>

    <!-- WOW.js for scrolling animations -->
    <script src="{{ asset('frontend/js/wow.min.js') }}"></script>

    <!-- ExZoom for image zooming functionality -->
    <script src="{{ asset('frontend/js/jquery.exzoom.js') }}"></script>

    <!-- Toastr JS for displaying notifications -->
    <script src="{{ asset('frontend/js/toastr.min.js') }}"></script>

    <!-- Main custom JS for frontend interactions -->
    <script src="{{ asset('frontend/js/main.js') }}"></script>

    <!--=============================
        ERROR HANDLING AND AJAX CONFIGURATION
    ==============================-->
    <script>
        // Display Toastr error notifications if there are validation errors
        @if ($errors->any())
            toastr.options = {
                "timeOut": "12000", // Duration of notification (12 seconds)
                "extendedTimeOut": "5000", // Additional time on hover (5 seconds)
                "closeButton": true, // Show close button
                "progressBar": true, // Show progress bar
            };

            // Loop through each error and display as toastr notification
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif

        // AJAX setup to include CSRF token in requests for security
        // meta tags – Handles character encoding and viewport settings
        // for mobile responsiveness. CSRF tokens are essential
        // for securing AJAX requests in Laravel.
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <!-- Load global js  -->
    @include('frontend.layouts.globalScript')
    <!--=============================
        STACK SCRIPTS
    ==============================-->
    <!-- Additional scripts pushed by specific views will be inserted here
    @ stack('scripts') – This allows you to push scripts
    from different views to load at the end of the body.-->

    @stack('scripts')

</body>

</html>
