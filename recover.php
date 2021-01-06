<?php
ob_start();
session_start();
require_once('db-config.php');
if(isset($_SESSION['url']))
{
    header("location:".$_SESSION['url']);
}
if(isset($_POST['submit']))
{
    $email = $_POST['email'];
    $sql = "Select * from account where email = '$email'";
    $result = mysqli_query($con,$sql);
    if(mysqli_num_rows($result) > 0)
    {
        $otp = mt_rand(100000, 999999);
        $sql = "Update account set otp = '$otp' Where email = '$email'";
        mysqli_query($con,$sql);
        mail($email, "Verification Code From Job Lister", "Verification Code " . $otp);
        header("location:forgot-code.php?Email=$email");
    }
    else
    {
        $_GET['error'] = "YOUR EMAIL NOT EXIST";
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
    <link rel="stylesheet" href="style/create-style.css">
</head>
<body>
    <div class="container" style="height: 220px;">
        <div class="create-header">
            <h1>FORGOT PASSWORD</h1>
        </div>
        <div class="error-account">
            <p class="error-create" style="margin-bottom: -10px;"><?php if(isset($_GET["error"])){echo $_GET["error"];}?></p>
        </div>
        <div class="create-form">
            <form action="" method="POST">
                <div class="input-form">
                    <input class="create-account" name="email" type="text" placeholder="Enter Email Address" required>
                </div>
                <div class="create-button" style="margin-top:-20px;">
                    <button class="create-submit" type="submit" name="submit">SUBMIT</button>
                </div>
            </form>
    </div>
</body>
</html>