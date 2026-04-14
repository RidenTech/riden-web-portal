<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RIDEN ADMIN </title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/icon.png') }}">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Audiowide&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
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

        .welcome-title {
            color: var(--text-main);
            font-weight: 700;
            text-align: center;
            margin-bottom: 0.5rem;
            font-size: 1.5rem;
        }

        .welcome-subtitle {
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

        .form-check-label {
            color: var(--text-sub);
            font-size: 0.9rem;
        }

        .forgot-link {
            color: #fff;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: opacity 0.2s;
        }

        .forgot-link:hover {
            opacity: 0.8;
            color: #d4d4d4ff;
        }

        .btn-login {
            background: var(--accent-color);
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 700;
            color: white;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            background: var(--accent-color);
            box-shadow: 0 10px 20px -10px var(--accent-color);
            color: white;
        }

        .form-check-input {
            background-color: transparent;
            border-color: var(--glass-border);
        }

        .form-check-input:checked {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
        }

        .invalid-feedback {
            font-size: 0.8rem;
            color: #ff6b6b;
        }

        .password-wrapper {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--text-sub);
            z-index: 10;
            transition: color 0.2s;
        }

        .password-toggle:hover {
            color: white;
        }
    </style>
</head>

<body>
    <div class="login-glass-card">
        <div class="brand-logo">RIDEN</div>
        <h2 class="welcome-title">Admin Login</h2>
        <p class="welcome-subtitle">Please enter your credentials to continue</p>

        <form action="{{ route('admin.login.post') }}" method="POST">
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

            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <div class="password-wrapper">
                    <input type="password" name="password" class="form-control premium-input @error('password') is-invalid @enderror" id="password"
                        placeholder="••••••••" required>
                    <i class="bi bi-eye password-toggle" id="togglePassword"></i>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        Keep me logged in
                    </label>
                </div>
                <a href="{{ route('admin.forgot') }}" class="forgot-link">Forgot Password?</a>
            </div>

            <button type="submit" class="btn btn-login w-100">Login</button>
        </form>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');

            togglePassword.addEventListener('click', function() {
                // Toggle the type attribute
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                
                // Toggle the eye icon
                this.classList.toggle('bi-eye');
                this.classList.toggle('bi-eye-slash');
            });
        });
    </script>
</body>

</html>
