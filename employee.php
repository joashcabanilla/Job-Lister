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
            <a class="link" href="logout.php">LOGOUT</a>  
        </div>
    </div>
    <div class="category">
        <div class="category-title">
        <h1 style="font-size:50px; display:flex; justify-content:center;">Select Category</h1>
        <form action="" method="POST">
            <div class="category-form">
                <div>
                    <select class="category-select" name="category">
                        <option value="Latest">Choose Category</option>
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
                </div>
                <div>
                    <button class="button" type="submit" name="submit-category">FIND</button>
                </div>
                <div>
                <input name="search" type="text" class="edit-input" style="margin-top:20px; width:500px;font-size:15px;" placeholder="Search Job Title,Company,Employer or Location">
                <button class="button" type="submit" name="search-button">Search</button>
                </div>    
            </div>
        </form>
        </div>
    </div>
    <div class="content">
        <div class="job-category">
            <h1 style="font-size:30px; margin-left:60px;">
            <?php if(isset($_POST['submit-category']))
            {   
                $label =  $_POST['category'];
                if($label == "Latest")
                {
                    echo "Latest Job";
                }
                else
                {
                    echo "Jobs In " . $_POST['category'];
                }
            }
            else
            {echo "Latest Job";} 
            ?></h1>
        </div>
    </div>
    <div class="job-database">
            <?php
            $email = $_SESSION['user'];
            function view_data($data)
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
                echo "<div class='job'> 
                            <h1 style='font-size: 25px; margin-top:5px;'>$job_title</h1>
                            <p>Company: $company</p>
                            <p>Location: $location</p>
                            <p> Date Posted: $date</p>
                            <a style='background:#054d7a; color:white;'class = 'view' href='job-view.php?id=$id'>VIEW</a>
                            </div>";
            } 
            if(isset($_POST['submit-category']))
            {
                $category = $_POST['category'];
                if($category == "Latest")
                {
                    $sql = "Select * From job order by date desc LIMIT 3";
                    $result = mysqli_query($con,$sql);
                    while($data = mysqli_fetch_assoc($result))
                    {
                        view_data($data);
                    }
                }
                else
                {
                    $sql = "Select * From job Where category = '$category' order by date desc";
                $result = mysqli_query($con,$sql);
                while($data = mysqli_fetch_assoc($result))
                {
                    view_data($data);
                }
                if(mysqli_num_rows($result) == 0)
                {
                    echo "<h1 style='font-size: 25px; margin-top:5px; color: maroon;'>'NO JOBS FOUND'</h1>";
                }
                }
            }
            else
            {
                if(isset($_POST['search-button']))
            {
                $job_title = $_POST['search'];
                $sql = "Select * From job where job_title LIKE '%$job_title%' or location LIKE '$job_title' or company LIKE '$job_title' or employer LIKE '$job_title' order by date desc";
                $result = mysqli_query($con,$sql);
                while($data = mysqli_fetch_assoc($result))
                {
                    view_data($data);
                }
                if(mysqli_num_rows($result) == 0)
                {
                    echo "<h1 style='font-size: 25px; margin-top:5px; color: maroon;'>'NO JOBS FOUND'</h1>";
                }
            }
            else
            {
                $sql = "Select * From job order by date desc LIMIT 3";
                $result = mysqli_query($con,$sql);
                while($data = mysqli_fetch_assoc($result))
                {
                    view_data($data);
                }
            }
            }
            ?>  
        </div>
</div>
</body>
</html>