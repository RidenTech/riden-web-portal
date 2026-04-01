<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RIDEN | Forgot Password</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
                            <h2 class="welcome-text">Forgot Password</h2>
                            <p class="sub-text">Enter Your Email Address</p>
                        </div>

                        <form action="forgot-sent.html">
                            <div class="mb-4">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control premium-input" id="email"
                                    placeholder="example@gmail.com" required>
                            </div>
                            <button type="submit" class="btn btn-login w-100">Send Link</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
