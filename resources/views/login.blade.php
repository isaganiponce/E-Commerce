<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ULAP Login</title>
    <script src="{{ asset('js/home.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* Border when placeholder is shown (input is empty) */
        input[type="email"]:placeholder-shown,
        input[type="password"]:placeholder-shown {
            border: 2px solid #000;
            /* Black border */
            border-radius: 5px;
        }

        /* Optional: Normal input (when user types) has lighter border */
        input[type="email"],
        input[type="password"] {
            border: 1px solid #aaa;
            border-radius: 5px;
        }
    </style>

</head>

<body>

    <div class="container-fluid vh-100 d-flex p-0">
        <div class="col-md-6 d-none d-md-flex flex-column justify-content-between p-0">
            <img src="{{ asset('images/logo_ulapp.png') }}" alt="ULAP Logo" style="width: 100%; height: 100%; object-fit: cover;">
        </div>

        <!-- Right Side Form -->
        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center p-5" style="background-color: #e9e9e9;">
            <!-- Need Help Link -->
            <div class="w-100 text-end mb-4">
                <a href="#" class="text-dark text-decoration-none">Need Help?</a>
            </div>

            <!-- Login Form -->
            <h2 class="fw-bold mb-4 w-100 text-start" style="max-width: 400px;">Login</h2>

            <!-- Errors -->
            <div class="alert alert-danger w-100" style="display: none; max-width: 400px;">
                <ul class="mb-0">
                    <li>Sample error message</li>
                </ul>
            </div>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}" class="w-100" style="max-width: 400px;">
                @csrf
                <!-- Email -->
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email Address" required autofocus style="font-style: italic;">
                    @error('email')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required style="font-style: italic;">
                    @error('password')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Forgot Password -->
                <div class="d-flex justify-content-end mb-3">
                    <a href="#" class="text-dark text-decoration-none">Forgot Password?</a>
                </div>

                <!-- Sign In Button -->
                <div class="mb-4">
                    <button type="submit" class="btn btn-dark w-100 py-2">Log In</button>
                </div>
            </form>


            <!-- Create Account -->
            <p>New to ULAP? <a href="{{ route('signup') }}" class="fw-bold text-dark text-decoration-none">Create an account</a></p>

            <!-- Social Icons -->
            <div class="text-center mt-4">
                <p class="mb-2" style="font-size: 1.25rem; font-weight: 600;">SOCIALS</p>
                <div class="d-flex gap-3 justify-content-center">
                    <a href="#"><i class="bi bi-tiktok fs-4 text-dark"></i></a>
                    <a href="#"><i class="bi bi-facebook fs-4 text-dark"></i></a>
                    <a href="#"><i class="bi bi-instagram fs-4 text-dark"></i></a>
                </div>
            </div>

            <!-- Footer -->
            <div class="mt-5 text-muted">
                © 2025 ULAP
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>