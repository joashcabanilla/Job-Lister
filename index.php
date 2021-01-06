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

    $sql = "Select * From account Where email = '$email' and password = '$password' and verification = 'true'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['user'] = $email;
        $row = mysqli_fetch_assoc($result);
        if ($row['user_account'] == 'Employee') {
            header("location:employee.php");
            remember("employee");
            $_SESSION['user-account'] = "employee";
        } else {
            header("location:employer.php");
            remember("employer");
            $_SESSION['user-account'] = "employer";
        }
    } else {
        $sql = "Select * From account Where email = '$email' and password = '$password' and verification = 'false'";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0) {
            header("location:verify.php?Email=$email");
        }
        else
        {
            $_GET['error'] = "INVALID EMAIL OR PASSWORD";
        }
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
            <p class="header-login">WELCOME TO JOB LISTER</p>
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
                    <input class="name" type="email" placeholder="Email" name="email" required value="<?php if(isset($_COOKIE["login-email"])){echo $_COOKIE["login-email"];}?>">
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
            <a class="forgot-link" href="recover.php">Forgot Password</a><a class="forgot-link" href="create.php">Create account</a>
    </div>
</body>
</html>