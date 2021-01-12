<?php
ob_start();
session_start();
require_once('db-config.php');
if (!isset($_SESSION['account'])) {
    header("location:index.php");
} else {
    $_SESSION['url'] = "employer.php";
    if (isset($_SESSION['user-account'])) {
        if ($_SESSION['user-account'] == "employee") {
            header("location:employee.php");
        }
    }
}
if(isset($_POST['save']))
{
    $email = $_SESSION['user'];
    date_default_timezone_set('Asia/Manila');
    $date = date("m/d/Y");
    $job_title = $_POST['job_title'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $company = $_POST['company'];
    $salary = $_POST['salary'];
    $contact_email = $_POST['contact_email'];
    $contact_number = $_POST['contact_number'];
    $category = $_POST['category'];
    $qualification = $_POST['qualification'];
    $experience = $_POST['experience'];
    $sql="Select * from account Where email = '$email'"; $result = mysqli_query($con,$sql); if(mysqli_num_rows($result) > 0){ $row = mysqli_fetch_assoc($result); $employer = $row['name'];}
    $sql = "Insert into job(job_title,description,location,company,salary,contact_email,contact_number,category,email,date,qualification,experience,employer) values('$job_title','$description','$location','$company','$salary','$contact_email','$contact_number','$category','$email','$date','$qualification','$experience','$employer')";
    mysqli_query($con,$sql);
    header("location:employer.php");
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
        <h1>Employer Name <?php $email = $_SESSION['user']; $sql="Select * from account Where email = '$email'"; $result = mysqli_query($con,$sql); if(mysqli_num_rows($result) > 0){ $row = mysqli_fetch_assoc($result); echo $row['name'];}?></h1>
        </div>
        <div class="header-link">
            <a class="link" href="employer.php">HOME</a>
            <a class="link" href="logout.php">LOGOUT</a>  
        </div>
    </div>
    <div class="category">
        <div class="category-title">
        <h1 style="font-size:50px; display:flex; justify-content:center;">Add Job</h1>
        <form action="" method="POST">
            <div class="category-form"> 
                <div class="div-edit-form">
                    <label class="label-form">Company</label>
                    <input class="edit-input" name="company" type="text" required>
                    <label class="label-form">Category</label>
                    <select class="edit-input" name="category">
                    <?php
                        require_once('db-config.php');
                            $sql = "Select * from category";
                            $result = mysqli_query($con,$sql);
                            while($row = mysqli_fetch_assoc($result))
                            {
                                $category = $row['category'];
                                echo "<option value='$category'>$category</option>";
                            }
                        ?>
                    </select>
                    <label class="label-form">Job Title</label>
                    <input class="edit-input" name="job_title" type="text" required>
                    <label class="label-form">Job Description</label>
                    <textarea style="height:160px; padding-top:10px;" class="edit-input" name="description" type="text" required></textarea>
                    <label class="label-form">Qualifications</label>
                    <textarea style="height:100px; padding-top:10px;" class="edit-input" name="qualification" type="text" required></textarea>
                    <label class="label-form">Experience</label>
                    <textarea style="height:100px; padding-top:10px;" class="edit-input" name="experience" type="text" required></textarea>
                    <label class="label-form">Location</label>
                    <textarea style="height:80px; padding-top:10px;" class="edit-input" name="location" type="text" required></textarea>
                    <label class="label-form">Salary</label>
                    <input class="edit-input" name="salary" type="text" required>
                    <label class="label-form">Contact Email</label>
                    <input class="edit-input" name="contact_email" type="email" required>
                    <label class="label-form">Contact Number</label>
                    <input class="edit-input" name="contact_number" type="number" pattern="[0-9]+" required>
                </div>
                <div style="margin-top:10px;padding-bottom: 20px;">
                    <button class="button" type="submit" name="save">SAVE</button>
                </div>   
            </div>
        </form>
        </div>
    </div>
    </div>
</body>
</html>