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
    if($row['flag']!=1){
        header('Location:redirect.php');
    }
}
else{
    header('Location:index.php?loginfirst');
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    </head>
    <body class="sb-nav-fixed">
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav  sb-sidenav-dark">
                    <div class="sb-sidenav-menu">
                        <div>
                            <a class="nav-link" href="index.php">Home</a>
                            <a class="nav-link" href="adminindex.php" >Admin Dashboard</a>
                            <a class="nav-link" href="admincontact.php">Messages</a>
                            <a class="nav-link" href="logout.php">Logout</a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small" style="font-size: small;">Logged in as:</div>
                        Admin
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                
                    
                        <style>
                            
                            #idk
                            {
                                
                                font-size: 20px;
                                padding-left:20px;

                                
                            }
                            
                        </style>
                        <?php 
                            $courid=$_GET['courseid'];
                            $query = "SELECT * FROM courses where courseid=$courid ";
                            
                            if ($result = $mysqli->query($query)) {
                                $row = $result->fetch_assoc();
                                $coursename = $row["coursename"];                            
                                $category = $row["category"]; 
                                $courseid=$row["courseid"];
                                $desc=$row["description"];
                                
                                echo "<h2 style='padding-left:20px'> Course Name:</h2><div id='idk'>" . $coursename . "</div><br>";
                                echo "<h2 style='padding-left:20px'>    Category:</h2><div id='idk'>" . $category . "</div><br>";
                                echo "<h2 style='padding-left:20px'> Description:</h2><div id='idk'>" . $desc . "</div><br>";
                            }
                            $sql="SELECT personid from map where courseid=$courid";
                            $res=$mysqli->query($sql);
                            $enrol=mysqli_num_rows($res);
                            echo "<h2 style='padding-left:20px'>Number of enrolled students:</h2><div id='idk'>".$enrol."</div><br>";

                                
                        ?>
                        <a href="editcoursedetails.php?courseid=<?=$courid?>" style='padding: 6px;
  margin-top: 8px;
  margin-right: 16px;
  background: #ddd;
  font-size: 17px;
  border: 1px;
  cursor: pointer;
  margin:auto;
  display:block;'><b><center>Edit Details</center></b></a>
                        <a href="editvideodetails.php?courseid=<?=$courid?>" style='padding: 6px;
  margin-top: 8px;
  margin-right: 16px;
  background: #ddd;
  font-size: 17px;
  border: 1px;
  cursor: pointer;
  margin:auto;
  display:block;'><b><center>Videos</center></b></a>
                    </div>
                
            
        </div>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </body>
</html>
