<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="Job Lister">
    <meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0">
    <link rel="shortcut icon" href="image/icon.ico">
    <title>Job Lister</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <div class="container">
        <div class="login-label">
            <p class="header-login">WELCOME TO JOB LISTER</p>
        </div>
        <div class="image">
            <img src="image/job.png" alt="csd" width="100" height="100">
        </div>
        <div class="error">
            <p class="error-message">INVALID USERNAME OR PASSWORD</p>
        </div>
        <div class="login-form">
            <form action="login.php" method="PSOT">
                <div class="input-name">
                    <input class="name" type="email" placeholder="Email" name="email" required>
                    <input class="name" type="password" placeholder="Password" name="password" required>
                </div>
                <div class="remember-div">
                    <label class="remember-label"><input class="remember" type="checkbox" name="remember"> Remember Me</label>
                </div>
                <div class="login-button">
                    <button class="button" type="submit" name="login">Log In</button>
                </div>
            </form>
        </div>
        <div class="forgot">
            <a class="forgot-link" href="forgot-password.php">Forgot Password</a><a class="forgot-link" href="signup.php">Sign Up</a>
        </div>
    </div>
</body>
</html>