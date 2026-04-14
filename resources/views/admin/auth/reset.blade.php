<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RIDEN ADMIN</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('/') }}assets\css\style.css">
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
                        <img src="{{ asset('/') }}assets\images\riden_car.png" alt="Happy couple in car" class="img-fluid hero-img">
                    </div>
                </div>

                <!-- Right Form Section -->
                <div class="col-lg-6 col-md-7 form-side d-flex align-items-center p-4 p-lg-5">
                    <div class="w-100">
                        <div class="text-center mb-4">
                            <h2 class="welcome-text">Reset Password</h2>
                            <p class="sub-text">Enter you New Password</p>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('admin.password.update') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="current-password" class="form-label">Current Password</label>
                                <div class="password-field-wrapper">
                                    <input type="password" name="current_password" class="form-control premium-input pe-5 @error('current_password') is-invalid @enderror" id="current-password"
                                        placeholder="Enter Current Password" required>
                                    <i class="bi bi-eye password-toggle"></i>
                                    @error('current_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="new-password" class="form-label">New Password</label>
                                <div class="password-field-wrapper">
                                    <input type="password" name="new_password" class="form-control premium-input pe-5 @error('new_password') is-invalid @enderror" id="new-password"
                                        placeholder="Enter New Password" required>
                                    <i class="bi bi-eye password-toggle"></i>
                                    @error('new_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-5">
                                <label for="confirm-password" class="form-label">Confirm Password</label>
                                <div class="password-field-wrapper">
                                    <input type="password" name="new_password_confirmation" class="form-control premium-input pe-5" id="confirm-password"
                                        placeholder="Confirm New Password" required>
                                    <i class="bi bi-eye password-toggle"></i>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-login w-100">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Simple toggle for password visibility
        document.querySelectorAll('.password-toggle').forEach(toggle => {
            toggle.addEventListener('click', function() {
                const input = this.parentElement.querySelector('input');
                if (input.type === 'password') {
                    input.type = 'text';
                    this.classList.remove('bi-eye');
                    this.classList.add('bi-eye-slash');
                } else {
                    input.type = 'password';
                    this.classList.remove('bi-eye-slash');
                    this.classList.add('bi-eye');
                }
            });
        });
    </script>
</body>

</html>
