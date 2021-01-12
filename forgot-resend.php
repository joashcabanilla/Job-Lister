<?php
ob_start();
session_start();
require_once('db-config.php');
$email = $_GET['Email'];
$otp = mt_rand(100000, 999999);
$sql = "Update account set otp='$otp' where email='$email'";
mysqli_query($con,$sql);
mail($email, "Verification Code From Job Lister", "Verification Code " . $otp);
header("location:forgot-code.php?Email=$email");
ob_end_flush();
?>