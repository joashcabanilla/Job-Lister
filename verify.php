<?php
ob_start();
session_start();
require_once('db-config.php');
if(isset($_SESSION['url']))
{
    header("location:".$_SESSION['url']);
}
if(!isset($_SESSION['email']))
{
    if(isset($_GET['Email']))
    {   
        $_SESSION['email'] = $_GET['Email'];
    }
    else
    {
        header("location:create.php");
    }
}
if(isset($_POST['submit']))
{
    $code = $_POST['code'];
    $email = $_SESSION['email'];
    $sql = "Select * from account where email = '$email' and otp = '$code' ";
    $result = mysqli_query($con,$sql);
    if(mysqli_num_rows($result) > 0)
    {
        $sql = "Update account set otp = '0',verification = 'true' Where email = '$email'";
        mysqli_query($con,$sql);
        header("location:index.php");
        unset($_SESSION['email']);
    }
    else
    {
        $_GET['error'] = "INCORRECT CODE";
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
            <h1>VERIFY ACCOUNT</h1>
            <p style = "display:flex; justify-content: center;font-family: 'Roboto Mono', monospace;font-size: 18px;"><?php if(isset($_SESSION["email"])){echo $_SESSION["email"];}?></p>
        </div>
        <div class="error-account">
            <p class="error-create" style="margin-bottom: -10px;"><?php if(isset($_GET["error"])){echo $_GET["error"];}?></p>
        </div>
        <div class="create-form">
            <form action="" method="POST">
                <div class="input-form">
                    <input class="create-account" name="code" type="text" placeholder="Enter Code" required>
                </div>
                <div class="create-button" style="margin-top:-20px;">
                    <button class="create-submit" type="submit" name="submit">VERIFY</button>
                </div>
            </form>
    </div>
</body>
</html>