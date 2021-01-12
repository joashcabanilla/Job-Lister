<?php 
session_start();
session_destroy();
if($_SESSION['user-account'] == "admin")
{
    header("location:admin-login.php");
}
else{
    header("location:index.php");
}


?>