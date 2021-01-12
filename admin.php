<?php
ob_start();
session_start();
require_once('db-config.php');
if (!isset($_SESSION['account'])) {
    header("location:admin-login.php");
}
else
{
    $_SESSION['url'] = "admin.php";
    if(isset($_SESSION['user-account']))
    {
        if($_SESSION['user-account'] == "employer")
        {
            header("location:employer.php");
        }
        elseif($_SESSION['user-account'] == "employee")
        {
            header("location:employee.php");
        }
    }
}
if(isset($_POST['add']))
{
    $category = ucwords($_POST['category']);
    $sql ="Insert Into category(category) values('$category')";
    mysqli_query($con,$sql);
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
        <div style="margin-top:5px;">
        <h1>WELCOME ADMIN</h1>
        </div>
        <div class="header-link">
            <a class="link" href="logout.php">LOGOUT</a>  
        </div>
    </div>
    <div class="category">
        <div class="category-title">
            <h1 style="font-size:40px; display:flex; justify-content:center;">MANAGE JOB CATEGORY</h1>
            <div style="margin-top:20px;margin-bottom:20px;">
                <form action="" method="POST">
                <input class="edit-input" name="category" style="width:500px;margin-right:20px;text-transform:capitalize;" placeholder="Enter Category">
                <button type="submit" name="add" class="button" style="width:100px;">ADD</button>
                </form>
            </div>
            <div style="display:flex;justify-content:center;">
                <div style="width:100%;">
                    <table>
                        <tr>
                            <th>
                                ID
                            </th>
                            <th>
                                CATEGORY
                            </th>
                            <th>
                                BUTTON
                            </th>
                        </tr>
                        <?php
                            require_once('db-config.php');
                            $sql = "Select * from category";
                            $result = mysqli_query($con,$sql);
                            while($row = mysqli_fetch_assoc($result))
                            {
                                $id = $row['id'];
                                $category = $row['category'];
                                echo "<tr>
                                    <td style='text-align:left;text-indent:10px;margin-left:10px;'>
                                    $id
                                    </td>
                                    <td style='text-align:left;text-indent:160px;width:400px;'>
                                    $category
                                    </td>
                                    <td>
                                        <a class='view' style='margin-top:20px;margin-right:10px;' href='delete-category.php?id=$id'>DELETE</a>
                                    </td>
                                </tr>";
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>