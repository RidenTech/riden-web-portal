<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RIDEN | Reset Password</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

                        <form action="reset-success.html">
                            <div class="mb-4">
                                <label for="new-password" class="form-label">New Password</label>
                                <div class="password-field-wrapper">
                                    <input type="password" class="form-control premium-input pe-5" id="new-password"
                                        placeholder="Enter Password" required>
                                    <span class="password-toggle">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="mb-5">
                                <label for="confirm-password" class="form-label">Confirm Password</label>
                                <div class="password-field-wrapper">
                                    <input type="password" class="form-control premium-input pe-5" id="confirm-password"
                                        placeholder="Enter Password" required>
                                    <span class="password-toggle">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                                            <path d="M13.359 11.238L15 12.879V11.238l-1.641-1.641zM2.641 4.762L1 3.121v1.641l1.641 1.641zm10.719 7.714L1.414 1.414 0 2.828l2.144 2.144C1.516 5.617 1 6.741 1 8c0 2.12 1.168 3.879 2.457 5.168A13.134 13.134 0 0 0 8 14.5c2.006 0 3.655-.956 4.931-2.112l1.655 1.655 1.414-1.414-1.622-1.622zM8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8c.06-.09.124-.187.198-.293l2.062 2.062C4.305 11.163 5.922 12.5 8 12.5zm4.846-5.46L10.783 9.102a3.5 3.5 0 0 1-4.885-4.885L8.102 6.42a2.5 2.5 0 0 0 3.138 3.138zM14.828 8c-.058-.087-.122-.183-.195-.288-.335-.48-.83-1.12-1.465-1.755C11.879 4.668 10.119 3.5 8 3.5c-.83 0-1.583.185-2.254.512L4.23 2.497A13.133 13.133 0 0 1 8 2.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8z"/>
                                        </svg>
                                    </span>
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
                const input = this.previousElementSibling;
                if (input.type === 'password') {
                    input.type = 'text';
                    // Optional: Change icon to eye-slash if needed
                } else {
                    input.type = 'password';
                }
            });
        });
    </script>
</body>

</html>
