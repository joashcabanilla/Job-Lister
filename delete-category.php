<?php
ob_start();
require_once('db-config.php');
$id = $_GET['id'];
$sql = "delete from category where id = '$id'";
mysqli_query($con,$sql);
header("location:admin.php");
ob_end_flush();
?>