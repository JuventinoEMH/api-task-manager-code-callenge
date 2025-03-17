<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

<div class="card-container">
    <div class="card">
        <h1>Login</h1>

        <form id="loginForm">
            @csrf
            <div>
                <input type="email" id="email" name="email" placeholder="Email Address" class="form-input" required>
                <div id="emailError" class="error"></div>
            </div>
            <div>
                <input type="password" id="password" name="password" placeholder="Password" class="form-input" required>
                <div id="passwordError" class="error"></div>
            </div>
            <div>
                <button type="submit" class="submit-btn">Login</button>
            </div>
        </form>

        <div class="register-link">
            <a href="/resgister">Don't have an account? Register</a>
        </div>
        <div class="register-link">
            <a href="/">Home</a>
        </div>
    </div>
</div>

<script>
    document.getElementById("loginForm").addEventListener("submit", function(event) {
        event.preventDefault();
        document.getElementById("emailError").innerHTML = '';
        document.getElementById("passwordError").innerHTML = '';

        var formData = new FormData(this);

        axios.post("/api/login", formData)
            .then(function(response) {
                localStorage.setItem("token", response.data.token);
                window.location.href = "/dashboard";
            })
            .catch(function(error) {
                if (error.response && error.response.data.errors) {
                    var errors = error.response.data.errors;
                    if (errors.email) {
                        document.getElementById("emailError").innerHTML = errors.email[0];
                    }
                    if (errors.password) {
                        document.getElementById("passwordError").innerHTML = errors.password[0];
                    }
                } else if (error.response && error.response.data.message) {
                    alert(error.response.data.message);
                }
            });
    });
</script>

</body>
</html>
