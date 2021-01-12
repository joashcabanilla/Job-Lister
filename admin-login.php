<?php
ob_start();
session_start();
require_once('db-config.php');
if(isset($_SESSION['url']))
{
    header("location:".$_SESSION['url']);
}
function remember($account)
{
    $_SESSION['account'] = $account;
    if (!empty($_POST['remember'])) {
        setcookie("login-email", $_POST["email"], time() + 86400);
        setcookie("login-password", $_POST["password"], time() + 86400);
    }
    else
    {
        setcookie("login-email","");
        setcookie("login-password","");  
    }
}
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "Select * From admin Where username = '$email' and password = '$password'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['user'] = $email;
        remember("admin");
        $_SESSION['user-account'] = "admin";
        header("location:admin.php");
    } else 
    {
        $_GET['error'] = "INVALID USERNAME OR PASSWORD";
    }
}
ob_end_flush();
?>
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
            <p class="header-login">ADMIN LOG IN</p>
        </div>
        <div class="image">
            <img src="image/job.png" alt="job" width="100" height="100">
        </div>
        <div class="error">
            <p class="error-message"><?php if(isset($_GET["error"])){echo $_GET["error"];}?></p>
        </div>
        <div class="login-form">
            <form action="" method="POST">
                <div class="input-name">
                    <input class="name" type="text" placeholder="Username" name="email" required value="<?php if(isset($_COOKIE["login-email"])){echo $_COOKIE["login-email"];}?>">
                    <input class="name" type="password" placeholder="Password" name="password" required value="<?php if(isset($_COOKIE["login-password"])){echo $_COOKIE["login-password"];}?>">
                </div>
                <div class="remember-div">
                    <label class="remember-label"><input class="remember" type="checkbox" name="remember" <?php if(isset($_COOKIE["login-email"])){?>checked<?php }?>> Remember Me</label>
                </div>
                <div class="login-button">
                    <button class="button" type="submit" name="login">Log In</button>
                </div>
            </form>
        </div>
    </div>
    <div class="forgot">
            <a class="forgot-link" href="index.php"> LOGIN APPLICANT/EMPLOYER</a>
    </div>
</body>
</html>