<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ULAP Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e9e9e9;
            height: 100vh;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
        }

        .form-container {
            background: #fff;
            padding: 2.0rem;
            border: 1px solid #999;
            max-width: 400px;
            width: 100%;
            padding-bottom: 4rem;
        }

        h2 {
            font-weight: 700;
        }

        p {
            margin-top: 0.5rem;
            margin-bottom: 2rem;
        }

        .form-control {
            background-color: #f0f0f0;
            border: 1px solid #000;
            border-radius: 0;
            padding: 0.4rem;
            /* Thinner input box */
            font-size: 0.9rem;
            /* Slightly smaller text for better proportion */
        }

        .form-control::placeholder {
            font-style: italic;
            font-weight: 200;
            /* Make placeholder thinner */
        }

        .login-link {
            font-weight: bold;
            color: black;
            text-decoration: underline;
        }

        .btn-dark {
            background-color: #333;
            border: none;
            border-radius: 0;
        }

        .btn-dark:hover {
            background-color: #000;
        }
    </style>
</head>

<body class="d-flex flex-column">

    <!-- Top Navbar -->
    <div class="top-bar">
        <img src="{{ asset('images/ulap-logo-transparent.png') }}" alt="ULAP Logo" style="width: 100px;">
        <a href="#" class="text-dark fw-bold text-decoration-none">Need Help?</a>
    </div>

    <!-- Center Form -->
    <div class="d-flex flex-grow-1 justify-content-center align-items-center">
        <div class="form-container text-center">
            <h2>Sign Up</h2>
            <p>Sign up to continue</p>

            <!-- Sign Up Form -->
            <form action="{{ route('signup.post') }}" method="POST" class="text-start">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Phone -->
                <div class="mb-3">
                    <input type="text" name="phone" class="form-control" placeholder="Phone">
                    @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Date of Birth -->
                <div class="mb-3">
                    <input type="date" name="dob" class="form-control" placeholder="Date of Birth">
                    @error('dob') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Gender -->
                <div class="mb-3">
                    <select name="gender" class="form-control">
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                    @error('gender') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Billing Address -->
                <div class="mb-3">
                    <input type="text" name="billing_address" class="form-control" placeholder="Billing Address">
                    @error('billing_address') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Shipping Address -->
                <div class="mb-3">
                    <input type="text" name="shipping_address" class="form-control" placeholder="Shipping Address">
                    @error('shipping_address') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                </div>

                <!-- Role -->
                <div class="mb-3">
                    <select name="role" class="form-control" required>
                        <option value="user" selected>User</option>
                        <option value="admin">Admin</option>
                    </select>
                    @error('role') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Remember Me -->
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember Me</label>
                </div>

                <!-- Sign Up Button -->
                <button type="submit" class="btn btn-dark w-100">Sign Up</button>
            </form>


            <!-- Already have account -->
            <p class="mt-4 mb-0">Already have an account? <a href="{{ route('login') }}" class="login-link">Log In</a>
            </p>
        </div>
    </div>

</body>

</html>
