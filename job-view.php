<?php
ob_start();
session_start();
require_once('db-config.php');
if (!isset($_SESSION['account'])) {
    header("location:index.php");
}
else
{
    $_SESSION['url'] = "employee.php";
    if(isset($_SESSION['user-account']))
    {
        if($_SESSION['user-account'] == "employer")
        {
            header("location:employer.php");
        }
        elseif($_SESSION['user-account'] == "admin")
        {
            header("location:admin.php");
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
    <link rel="stylesheet" href="style/employer.css">
</head>
<body>
<div class="container">
    <div class="header">
        <div>
        <h1>Applicant Name <?php $email = $_SESSION['user']; $sql="Select * from account Where email = '$email'"; $result = mysqli_query($con,$sql); if(mysqli_num_rows($result) > 0){ $row = mysqli_fetch_assoc($result); echo $row['name'];}?></h1>
        </div>
        <div class="header-link">
            <a class="link" href="employee.php">HOME</a>
            <a class="link" href="logout.php">LOGOUT</a>  
        </div>
    </div>
    <div class="content">
    <div class="job-database">
            <?php
            $email = $_SESSION['user'];
            $id = $_GET['id'];
            $sql = "Select * From job where job_id = $id";
                    $result = mysqli_query($con,$sql);
                    while($data = mysqli_fetch_assoc($result))
                    {
                        $job_title = $data['job_title'];
                $description = $data['description'];
                $date = $data['date'];
                $id = $data['job_id'];
                $location = $data['location'];
                $company = $data['company'];
                $salary = $data['salary'];
                $contact_email = $data['contact_email'];
                $contact_number = $data['contact_number'];
                $qualification = $data['qualification'];
                $experience = $data['experience'];
                echo "<div class='job' style='margin-top:40px;'> 
                                    <h1 style='font-size: 25px; margin-top:5px;'>$job_title</h1>
                                    <p>Job Description: $description</p>
                                    <p>Company: $company</p>
                                    <p>Qualification: $qualification</p>
                                    <p>Experience: $experience</p>
                                    <p>Location: $location</p>
                                    <p>Salary: $salary</p>
                                    <p>Contact Email: $contact_email</p>
                                    <p>Contact Number: $contact_number</p>
                                    <p> Date Posted: $date</p>
                                   </div>";
                    }
            ?>  
        </div>
</div>
</body>
</html>