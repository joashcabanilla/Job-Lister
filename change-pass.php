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
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $email = $_GET['Email'];
    if($password != $confirmpassword)
    {
        $_GET['error'] = "PASSWORD DO NOT MATCH";
    }
    else
    {        
        $sql = "Update account set password = '$password' Where email = '$email'";
        mysqli_query($con,$sql);
        header("location:index.php");
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
    <div class="container" style="height: 250px;">
        <div class="create-header">
            <h1>CHANGE YOUR PASSWORD</h1>
            <p style = "display:flex; justify-content: center;font-family: 'Roboto Mono', monospace;font-size: 18px;"><?php if(isset($_GET["Email"])){echo $_GET["Email"];}?></p>
        </div>
        <div class="error-account">
            <p class="error-create" style="margin-bottom: -10px;"><?php if(isset($_GET["error"])){echo $_GET["error"];}?></p>
        </div>
        <div class="create-form">
            <form action="" method="POST">
                <div class="input-form">
                    <input class="create-account" name="password" type="password" placeholder="Enter New Password" required>
                    <input class="create-account" name="confirmpassword" type="password" placeholder="Confirm Password" required>
                </div>
                <div class="create-button" style="margin-top:-20px;">
                    <button class="create-submit" type="submit" name="submit">SAVE</button>
                </div>
            </form>
    </div>
</body>
</html>