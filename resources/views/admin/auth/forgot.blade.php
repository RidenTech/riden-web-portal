<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RIDEN | Webportal</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/icon.png') }}">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Audiowide&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --accent-color: #D10000;
            --glass-bg: rgba(255, 255, 255, 0.08);
            --glass-border: rgba(255, 255, 255, 0.15);
            --text-main: #ffffff;
            --text-sub: rgba(255, 255, 255, 0.8);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('assets/images/login.jpg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 10px;
        }

        .login-glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid var(--glass-border);
            border-radius: 28px;
            padding: 3rem 2.3rem;
            width: 100%;
            max-width: 460px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7);
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .brand-logo {
            font-family: 'Audiowide', cursive;
            font-size: 56px;
            font-weight: 500;
            color: #D10000;
            text-align: center;
            margin-bottom: 0.2rem;
            letter-spacing: 1.5px;
        }

        .page-title {
            color: var(--text-main);
            font-weight: 700;
            text-align: center;
            margin-bottom: 0.5rem;
            font-size: 1.5rem;
        }

        .page-subtitle {
            color: var(--text-sub);
            text-align: center;
            font-size: 0.95rem;
            margin-bottom: 2rem;
            font-weight: 400;
        }

        .form-label {
            color: var(--text-sub);
            font-weight: 500;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .premium-input {
            background: rgba(224, 88, 99, 0.1) !important;
            border: 1px solid var(--glass-border) !important;
            border-radius: 12px !important;
            color: white !important;
            padding: 12px 16px !important;
            transition: all 0.3s ease;
        }

        .premium-input:focus {
            box-shadow: 0 0 0 4px rgba(223, 20, 37, 0.2) !important;
            border-color: var(--accent-color) !important;
            background: rgba(255, 255, 255, 0.1) !important;
        }

        .premium-input::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        .btn-action {
            background: var(--accent-color);
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 700;
            color: white;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -10px var(--accent-color);
            background: #D10000;
            color: white;
        }

        .btn-action:active {
            transform: translateY(0);
            background: var(--accent-color) !important;
            opacity: 0.9;
            color:white !important;
        }

        .btn-action:focus {
            outline: none;
            box-shadow: 0 0 0 4px rgba(209, 0, 0, 0.2);
            background: var(--accent-color);
        }

        .back-link {
            color: #fff;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: opacity 0.2s;
        }

        .back-link:hover {
            opacity: 0.8;
            color: #d4d4d4ff;
        }

        .invalid-feedback {
            font-size: 0.8rem;
            color: #ff6b6b;
        }
    </style>
</head>

<body>
    <div class="login-glass-card">
        <div class="brand-logo">RIDEN</div>
        <h2 class="page-title">Forgot Password</h2>
        <p class="page-subtitle">Enter your email address to receive a recovery link</p>

        <form action="{{ route('admin.forgot') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control premium-input @error('email') is-invalid @enderror" id="email"
                    placeholder="name@riden.com" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-action w-100">Send Recovery Link</button>
            
            <div class="text-center mt-4">
                <a href="{{ route('admin.login') }}" class="back-link">Return to Login</a>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body class="d-flex align-items-center justify-content-center min-vh-100 p-3">

    <div class="login-container">
        <!-- Main Card -->
        <div class="card main-card overflow-hidden">
            <div class="row g-0">
                <!-- Left Illustration Section -->
                <div
                    class="col-lg-6 col-md-5 illustration-side d-flex flex-column align-items-center justify-content-center p-4">
                    <h1 class="brand-name">RIDEN</h1>
                    <div class="illustration-wrapper mt-auto">
                        <img src="{{ asset('assets/images/riden_car.png') }}" alt="Happy couple in car" class="img-fluid hero-img">
                    </div>
                </div>

                <!-- Right Form Section -->
                <div class="col-lg-6 col-md-7 form-side d-flex align-items-center p-4 p-lg-5">
                    <div class="w-100">
                        <div class="text-center mb-4">
                            <h2 class="welcome-text">Forgot Password</h2>
                            <p class="sub-text">Enter Your Email Address</p>
                        </div>

                        <form action="{{ route('admin.forgot') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control premium-input @error('email') is-invalid @enderror" id="email"
                                    placeholder="example@gmail.com" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-login w-100">Send Link</button>
                            <div class="text-center mt-3">
                                <a href="{{ route('admin.login') }}" class="forgot-password">Back to Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Bootstrap Bundle -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- SweetAlert2 JS -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <script>
        const RidenSwal = Swal.mixin({
            confirmButtonColor: '#e11d48',
            cancelButtonColor: '#111',
            customClass: {
                popup: 'riden-swal-popup',
                confirmButton: 'btn btn-danger rounded-pill px-4',
                cancelButton: 'btn btn-dark rounded-pill px-4'
            }
        });

        @if(session('status'))
            RidenSwal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('status') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if(session('error'))
            RidenSwal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}'
            });
        @endif

        @if ($errors->any())
            RidenSwal.fire({
                icon: 'error',
                title: 'Request Failed',
                html: '<ul class="text-start">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>'
            });
        @endif
    </script>
</body>

</html>
