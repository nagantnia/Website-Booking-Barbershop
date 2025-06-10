<!-- filepath: c:\laravel\barbershop\resources\views\auth\register.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - El Barber</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            background: #292D33;
        }

        .container {
            display: flex;
            width: 100%;
        }

        .left-section {
            flex: 1;
            background-image: url('{{ asset("images/barber-login.jpg") }}');
            background-size: cover;
            background-position: center;
        }

        .right-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3rem;
            background: #292D33;
        }

        .register-form {
            max-width: 400px;
            width: 100%;
            margin: 0 auto;
        }

        .register-header {
            margin-bottom: 2rem;
        }

        .register-header h1 {
            color: #fff;
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .login-text {
            color: #9D9570;
            font-size: 0.9rem;
        }

        .login-text a {
            color: #fff;
            text-decoration: none;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            color: #fff;
            margin-bottom: 0.5rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #9D9570;
            border-radius: 5px;
            background: transparent;
            color: #fff;
            font-size: 1rem;
        }

        .form-control:focus {
            outline: none;
            border-color: #fff;
        }

        .btn-register {
            width: 100%;
            padding: 0.75rem;
            background: #9D9570;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-register:hover {
            background: #817c5b;
        }

        .text-danger {
            color: #fc0000;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        @media (max-width: 768px) {
            .left-section {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-section"></div>
        <div class="right-section">
            <div class="register-form">
                <div class="register-header">
                    <h1>Register</h1>
                    <p class="login-text">
                        Already have an account? 
                        <a href="{{ route('login') }}">Login here!</a>
                    </p>
                </div>

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="{{ old('name') }}" placeholder="Enter your name" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="{{ old('email') }}" placeholder="Enter your email address" required>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" 
                               placeholder="Enter your password" required>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" 
                               name="password_confirmation" placeholder="Confirm your password" required>
                    </div>

                    <button type="submit" class="btn-register">Register</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>