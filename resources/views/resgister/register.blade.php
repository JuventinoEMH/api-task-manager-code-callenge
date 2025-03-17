<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

<div class="card-container">
    <div class="card">
        <h1>Register</h1>

        <form id="registerForm">
            @csrf

            <div>
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Name" class="form-input" required>
                <div id="nameError" class="error"></div>
            </div>

            <div>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Email Address" class="form-input" required>
                <div id="emailError" class="error"></div>
            </div>

            <div>
                <input type="password" id="password" name="password" placeholder="Password" class="form-input" required>
                <div id="passwordError" class="error"></div>
            </div>

            <div>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" class="form-input" required>
                <div id="passwordConfirmationError" class="error"></div>
            </div>

            <div>
                <button type="submit" class="submit-btn">Register</button>
            </div>
        </form>

        <div class="register-link">
            <a href="/login">Already have an account? Login</a>
        </div>
        <div class="register-link">
            <a href="/">Home</a>
        </div>
    </div>
</div>



</body>
</html>
