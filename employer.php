<?php
ob_start();
session_start();
if (!isset($_SESSION['account'])) {
    header("location:index.php");
}
else{
    $_SESSION['url'] = "employer.php";
    if(isset($_SESSION['user-account']))
    {
        if($_SESSION['user-account'] == "employee")
        {
            header("location:employee.php");
        }
    }
}
ob_end_flush();
?>
<!DOCTYPE html>
<html>
<a href="logout.php">LOGOUT</a>
</html>