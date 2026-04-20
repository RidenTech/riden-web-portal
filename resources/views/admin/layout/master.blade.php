<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>RIDEN | Webportal</title>
        <link rel="icon" type="image/png" href="{{ asset('assets/images/icon.png') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="RIDEN | Webportal" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Audiowide&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Bootstrap 5 -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-icons/font/bootstrap-icons.css') }}">

        <!-- App CSS -->
        <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet" type="text/css" />
        
        <!-- SweetAlert2 -->
        <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
        
        @stack('styles')

    </head>
    <body class="riden-body">
        @include('admin.template.header')
        @include('admin.template.sidebar')
        <main id="wrapper" class="riden-main">
            <div class="container-fluid riden-content-wrapper">
                <div class="row justify-content-center">
                    @yield('content')
                </div>
            </div>
        </main>

        <!-- Bootstrap 5 JS -->
        <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        
        <!-- SweetAlert2 JS -->
        <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>
        
        <script src="{{ asset('assets/js/admin.js') }}"></script>

        <script>
            // Global SweetAlert2 Configuration & Flash Handler
            const RidenSwal = Swal.mixin({
                confirmButtonColor: '#e11d48',
                cancelButtonColor: '#111',
                customClass: {
                    popup: 'riden-swal-popup',
                    confirmButton: 'btn btn-danger rounded-pill px-4',
                    cancelButton: 'btn btn-dark rounded-pill px-4'
                }
            });

            @if(session('status') || session('success'))
                RidenSwal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('status') ?? session('success') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif

            @if(session('statusDanger'))
                RidenSwal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session('statusDanger') }}'
                });
            @endif

            @if ($errors->any())
                RidenSwal.fire({
                    icon: 'error',
                    title: 'Input Issues',
                    html: '<ul class="text-start">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>'
                });
            @endif
            
            // Reusable Confirm Functions
            window.confirmDelete = (title = 'Are you sure?', text = "You won't be able to revert this!") => {
                return RidenSwal.fire({
                    title: title,
                    text: text,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel',
                    reverseButtons: true
                });
            };

            window.confirmAction = (title, text, icon = 'warning', confirmText = 'Yes, proceed') => {
                return RidenSwal.fire({
                    title: title,
                    text: text,
                    icon: icon,
                    showCancelButton: true,
                    confirmButtonText: confirmText,
                    cancelButtonText: 'Cancel',
                    reverseButtons: true
                });
            };
        </script>
        @stack('scripts')

    </body>
</html>
