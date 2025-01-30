<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    {{-- CSRF token for securing AJAX requests in Laravel --}}
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>General Dashboard &mdash; Stisla</title>

    {{-- General CSS Files --}}
    <link rel="stylesheet" href="{{ asset("admin/assets/modules/bootstrap/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/select2/dist/css/select2.min.css') }}">

    <link rel="stylesheet" href="//cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
    {{-- Template CSS --}}
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/components.css') }}">
    {{-- Start GA --}}
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        var pusherKey = "{{ config('settings.pusher_key') }}";
        var pusherCluster = "{{ config('settings.pusher_cluster') }}";
        var loggedInUserId = "{{ Auth::user()->id }}";
    </script>
    <!-- /END GA -->
    @vite(['resources/js/app.js', 'resources/js/admin.js'])
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>

            {{-- I remove the tags Nav and aside and I put on the new file called
        siderbar.blade.php
        this file is on the folder view/admin/layouts/sidebar.blade.php
        --}}

            @include('admin.layouts.sidebar')

            {{-- Main Content --}}
            <div class="main-content">
                @yield('content')
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad
                        Nauval Azhar</a>
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>

    {{-- General JS Scripts --}}
    <script src="{{ asset('admin/assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/popper.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/tooltip.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/stisla.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>

    {{-- A beautiful, responsive, customizable,
        accessible (WAI-ARIA) replacement for JavaScript's popup boxes
        Zero dependencies--}}
    <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script src="{{ asset('admin/assets/modules/select2/dist/js/select2.full.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Template JS File --}}
    <script src="{{ asset('admin/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('admin/assets/js/custom.js') }}"></script>
    {{-- toastr js --}}
    <script src="{{ asset('frontend/js/toastr.min.js') }}"></script>

    <script>
        @if ($errors->any())
            toastr.options = {
                "timeOut": "12000", // 12 seconds
                "extendedTimeOut": "5000", // 5 seconds on hover
                "closeButton": true,
                "progressBar": true,
            };

            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>

    <script>
        $.uploadPreview({
            input_field: "#image-upload", // Default: .image-upload
            preview_box: "#image-preview", // Default: .image-preview
            label_field: "#image-label", // Default: .image-label
            label_default: "Choose File", // Default: Choose File
            label_selected: "Change File", // Default: Change File
            no_label: false, // Default: false
            success_callback: null // Default: null
        });
        //$(".inputtags").tagsinput('items');
        //$("select").selectric();
        // AJAX setup to include CSRF token in requests for security
        // meta tags – Handles character encoding and viewport settings
        // for mobile responsiveness. CSRF tokens are essential
        // for securing AJAX requests in Laravel.
        /**
         * This $.ajaxSetup({... under this comment was not working properly
         * instead of that I create a tocken inside the code
         *  $('body').on('click', '.delete-item', function(e) {
         * in its option ajax data:...
         * like
         *          data: {_token: {{ csrf_token() }}},
         */
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });

        $(document).ready(function() {
            $('body').on('click', '.delete-item', function(e) {
                e.preventDefault()
                let urlHref = $(this).attr('href');
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: 'DELETE',
                            //this variable urlHref I declare and put the value before at the top of the script
                            url: urlHref,
                            data: {_token: "{{ csrf_token() }}"},
                            success: function(response) {
                                if (response.status === 'success') {
                                    toastr.success(response.message);
                                    //$('#slider-table').DataTable().draw();
                                    //instead the line above this
                                    // it's remplasing by the next code
                                    window.location.reload();
                                } else {
                                    toastr.erro(response.message);
                                }
                            },
                            error: function(error) {
                                console.error(error);
                            },
                        })
                        /**
                         * Instead of this piece if code from the sweetAlert
                         * I use toastr inside the condition
                         * if(response.status === 'success'){
                         * and I commented the next code -> Swal.fire({
                         */
                        // Swal.fire({
                        //     title: "Deleted!",
                        //     text: "Your file has been deleted.",
                        //     icon: "success"
                        // });
                    }
                });
            })

        })
    </script>
    @stack('scripts')

</body>

</html>
