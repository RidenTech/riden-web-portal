<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RIDEN | Login</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body class="d-flex align-items-center justify-content-center min-vh-100 p-3">
    <!-- ... (body content stays the same) ... -->
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
                            <h2 class="welcome-text">Welcome Back!</h2>
                            <p class="sub-text">Enter Email Address & Password</p>
                        </div>

                        <form action="{{ route('admin.login.post') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="text" name="email" class="form-control premium-input @error('email') is-invalid @enderror" id="email"
                                    placeholder="example@gmail.com" value="{{ old('email') }}" required autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control premium-input @error('password') is-invalid @enderror" id="password"
                                    placeholder="Enter Password" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label sub-text" for="remember">
                                        Remember Me
                                    </label>
                                </div>
                                <a href="{{ route('admin.forgot') }}" class="forgot-password">Forgot Password?</a>
                            </div>
                            <button type="submit" class="btn btn-login w-100">Log In</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
                title: 'Access Denied',
                html: '<ul class="text-start">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>'
            });
        @endif
    </script>
</body>

</html>
