<?php
session_start();
$username = "root"; 
$password = ""; 
$database = "project"; 
$mysqli = new mysqli("localhost", $username, $password, $database); 
if (isset($_SESSION['logged']))
{
    $id=$_SESSION['pid'];
    $sql="SELECT * FROM login where personid=$id";
    $res=$mysqli->query($sql);
    $row = $res->fetch_assoc();
    if($row['flag']==1){
        header('Location:redirect.php');
    }
}
else{
    header('Location:index.php?loginfirst');
}
$mysqli -> close();
?>

<!DOCTYPE html>
<?php
    $con=mysqli_connect('localhost','root','','project');
?>
<html lang="en">
    <head>
        <title>Profile</title>
        
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
        
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar  navbar-dark bg-dark">
            <a class="heading">Profile</a>
            <a class="nav_s"></a>
            <a class="navbar-b" href="index.php">Home</a>
            <a class="navbar-b" href="contact.php">Contact</a>
        </nav>
        <?php
        
        $id=$_SESSION['pid'];                 
        $result=mysqli_query($con,"select * from login where personid='$id'");
        $x=$result-> fetch_assoc();
        $username=$x["username"];
        $password=$x["password"];
        
        ?>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav  sb-sidenav-dark">
                    <div class="sb-sidenav-menu">
                        <div>
                            <a class="nav-link" href="disp_courses.php">Add Courses</a>
                            <a class="nav-link" href="personal.php">Personal Info</a>
                            <a class="nav-link" href="change_psw.php?id=<?php echo $id; ?>">Change Password</a>
                            <a class="nav-link" href="logout.php">Logout</a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small" style="font-size: small;">Logged in as:</div>
                        <?php echo $username; ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content" >
                <main>
                    <div>
                        <ol class="breadcrumb mb-4" >
                            <li class="breadcrumb-item"><a >Dashboard</a></li>
                        </ol>
                        <table id="t01">
                            <tr>
                                <th>Course Name</th>
                                <th>Description</th>
                                <th>Category</th>
                            </tr>
                            
                            <?php
                            
                                $result = mysqli_query($con, "SELECT * FROM `courses` WHERE `courseid` IN(SELECT `courseid` FROM map WHERE personid='$id')");
                                if($result-> num_rows >0){
                                    while($row = $result-> fetch_assoc())
                                    {
                                        echo '<tr>
                                                <td>'.$row["coursename"].'</td>
                                                <td>'.$row["description"].'</td>
                                                <td>'.$row["category"].'</td>
                                            </tr>';
                                    }
                                    }
							?>	
                        </table>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </body>
</html>
