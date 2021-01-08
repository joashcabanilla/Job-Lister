<?php
ob_start();
session_start();
require_once('db-config.php');
if(isset($_SESSION['url']))
{
    header("location:".$_SESSION['url']);
}
if(isset($_POST['submit-account']))
{
    $user_account = $_POST['user_account'];
    $name = $_POST['create-name'];
    $email = $_POST['create-email'];
    $password = $_POST['create-password'];
    $confirmpassword = $_POST['create-confirmpassword'];
    $otp = mt_rand(100000, 999999);
    $verification = "false";
    $sql = "Select * from account where email = '$email'";
    $result = mysqli_query($con,$sql);
    if(mysqli_num_rows($result) > 0)
    {
        $_GET['error'] = "YOU HAVE ALREADY ACCOUNT";
        $_GET['name'] = $name;
        $_GET['email'] = $email;
        $_GET['password'] = $password;
        $_GET['confirmpassword'] = $confirmpassword;
    }
    elseif($password != $confirmpassword)
    {
        $_GET['error'] = "PASSWORD NOT MATCH";
        $_GET['name'] = $name;
        $_GET['email'] = $email;
        $_GET['password'] = $password;
        $_GET['confirmpassword'] = $confirmpassword;
    }
    else
    {
        $sql = "Insert Into account(email,name,password,otp,verification,user_account) values('$email','$name','$password','$otp','$verification','$user_account')";
        mysqli_query($con,$sql);
        mail($email, "Verification Code From Job Lister", "Verification Code " . $otp);
        header("location:verify.php?Email=$email");
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
    <div class="container">
        <div class="create-header">
            <h1>CREATE NEW ACCOUNT</h1>
        </div>
        <div class="error-account">
            <p class="error-create"><?php if(isset($_GET["error"])){echo $_GET["error"];}?></p>
        </div>
        <div class="create-form">
            <form action="" method="POST">
            <div class="div-create">
            <div>
            <p class="select-label">Select User Account</p>
            </div>
            <div class="div-combo">
                <select class="select-combo" name="user_account">
                <option value="Employee">Employee</option>
                <option value="Employer">Employer</option>
                </select>
                </div>
            </div>
                <div class="input-form">
                    <input class="create-account" name="create-name" type="text" placeholder="Enter Name" required value= "<?php if(isset($_GET["name"])){echo $_GET["name"];}?>">
                    <input class="create-account" name="create-email" type="email" placeholder="Enter Email Address" required value="<?php if(isset($_GET["email"])){echo $_GET["email"];}?>">
                    <input class="create-account" name="create-password" type="password" placeholder="Enter Password" required value="<?php if(isset($_GET["password"])){echo $_GET["password"];}?>">
                    <input class="create-account" name="create-confirmpassword" type="password" placeholder="Confirm Password" required value="<?php if(isset($_GET["confirmpassword"])){echo $_GET["confirmpassword"];}?>">
                </div>
                <div class="create-button">
                    <button class="create-submit" type="submit" name="submit-account">CREATE</button>
                </div>
            </form>
        </div>
    </div>
    <div class="forgot">
            <a class="forgot-link" href="index.php">Log In Account</a>
    </div>
</body>
</html>