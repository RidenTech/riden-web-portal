<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>@yield('title') | {{ env('APP_NAME','Select & Rent') }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Riden Admin" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Bootstrap 5 -->
        <link href="{{ asset('/') }}assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="{{ asset('/') }}assets/libs/bootstrap-icons/font/bootstrap-icons.css">

        <!-- App CSS -->
        <link href="{{ asset('/') }}assets/css/admin.css" rel="stylesheet" type="text/css" />
        @stack('styles')

    </head>
    <body class="riden-body">
        @include('admin.template.header')
        @include('admin.template.sidebar')
        <main id="wrapper" class="riden-main">
            <div class="container-fluid py-3 py-md-4">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                @if(session('statusDanger'))
                    <div class="alert alert-danger">{{ session('statusDanger') }}</div>
                @endif

                <div class="row justify-content-center">
                    @yield('content')
                </div>
            </div>
        </main>

        <!-- Bootstrap 5 JS -->
        <script src="{{ asset('/') }}assets/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('/') }}assets/js/admin.js"></script>
        @stack('scripts')

    </body>
</html>