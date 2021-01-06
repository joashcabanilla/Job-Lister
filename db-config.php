<?php
//xampp
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'job_lister';

//000webhost
/*$db_host = 'localhost';
$db_username = 'id15843148_chrissa';
$db_password = 'Job_lister_php_system_2020';
$db_name = 'id15843148_job_lister';*/

$con = mysqli_connect($db_host, $db_username, $db_password, $db_name);

if (!$con) {
    die('Error : (' . $con->connect_errno . ')' . $con->connect_error);
}
