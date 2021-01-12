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
if(!isset($_GET['id']))
{
    header("location:employer.php");
}
function job_data($con)
{   
    $id = $_GET['id'];
    $sql = "Select * from job Where job_id = '$id'";
    $result = mysqli_query($con,$sql);
    while($data = mysqli_fetch_assoc($result))
    {
        $job_title = $data['job_title'];
        $description = $data['description'];
        $location = $data['location'];
        $company = $data['company'];
        $salary = $data['salary'];
        $contact_email = $data['contact_email'];
        $contact_number = $data['contact_number'];
        $category = $data['category'];
        $qualification = $data['qualification'];
        $experience = $data['experience'];
        $_GET['job_title'] = $job_title;
        $_GET['description'] = $description;
        $_GET['location'] = $location;
        $_GET['company'] = $company;
        $_GET['salary'] = $salary;
        $_GET['contact_email'] = $contact_email;
        $_GET['contact_number'] = $contact_number;
        $_GET['category'] = $category;
        $_GET['qualification'] = $qualification;
        $_GET['experience'] = $experience;
    }
    
}
if(isset($_POST['save']))
{
    $id = $_GET['id'];
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
    $sql = "Update job set job_title = '$job_title',description = '$description',location = '$location',company = '$company',salary = '$salary',contact_email = '$contact_email',contact_number = '$contact_number',category = '$category',qualification = '$qualification',experience = '$experience' Where job_id = '$id'";
    mysqli_query($con,$sql);
    header("location:employer.php");
}
if(isset($_POST['delete']))
{
    $id = $_GET['id'];
    $sql = "delete from job where job_id = '$id'";
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
        <h1 style="font-size:50px; display:flex; justify-content:center;">Edit Job</h1>
        <form action="" method="POST">
            <div class="category-form"> 
                <div class="div-edit-form">
                    <label class="label-form">Company</label>
                    <input class="edit-input" name="company" type="text" value="<?php require_once('db-config.php'); job_data($con); echo $_GET['company']?>" required>
                    <label class="label-form">Category</label>
                    <select class="edit-input" name="category">
                    <?php
                        require_once('db-config.php');
                            $sql = "Select * from category";
                            $result = mysqli_query($con,$sql);
                            while($row = mysqli_fetch_assoc($result))
                            {
                                $category = $row['category'];
                                echo "<option value='$category'";
                                require_once('db-config.php'); 
                                job_data($con); 
                                $data = $_GET['category'];
                                if($category == $data)
                                {
                                    echo "selected";
                                }
                                echo">$category</option>";
                            }
                        ?>
                    </select>
                    <label class="label-form">Job Title</label>
                    <input class="edit-input" name="job_title" type="text" value="<?php require_once('db-config.php'); job_data($con); echo $_GET['job_title']?>" required>
                    <label class="label-form">Job Description</label>
                    <textarea style="height:160px; padding-top:10px;" class="edit-input" name="description" type="text" required><?php require_once('db-config.php'); job_data($con); echo $_GET['description']?></textarea>
                    <label class="label-form">Qualifications</label>
                    <textarea style="height:100px; padding-top:10px;" class="edit-input" name="qualification" type="text" required><?php require_once('db-config.php'); job_data($con); echo $_GET['qualification']?></textarea>
                    <label class="label-form">Experience</label>
                    <textarea style="height:100px; padding-top:10px;" class="edit-input" name="experience" type="text" required><?php require_once('db-config.php'); job_data($con); echo $_GET['experience']?></textarea>
                    <label class="label-form">Location</label>
                    <textarea style="height:80px; padding-top:10px;" class="edit-input" name="location" type="text" required><?php require_once('db-config.php'); job_data($con); echo $_GET['location']?></textarea>
                    <label class="label-form">Salary</label>
                    <input class="edit-input" name="salary" type="text" value="<?php require_once('db-config.php'); job_data($con); echo $_GET['salary']?>" required>
                    <label class="label-form">Contact Email</label>
                    <input class="edit-input" name="contact_email" type="email" value="<?php require_once('db-config.php'); job_data($con); echo $_GET['contact_email']?>" required>
                    <label class="label-form">Contact Number</label>
                    <input class="edit-input" name="contact_number" type="text" value="<?php require_once('db-config.php'); job_data($con); echo $_GET['contact_number']?>" required>
                </div>
                <div style="display:flex; justify-content:space-between; width:450px; margin-top:10px;padding-bottom: 20px;">
                    <button class="button" type="submit" name="save">SAVE</button>
                    <button class="button" type="submit" name="delete">DELETE</button>
                </div>   
            </div>
        </form>
        </div>
    </div>
    </div>
</body>
</html>