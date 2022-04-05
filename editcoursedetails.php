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
                <main>
                    <div>
                        <style>
                            input[type=text] {
                            width: 100%;
                            padding: 12px 20px;
                            
                            margin: 20px 0;
                            box-sizing: border-box;
                            margin:auto;
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
                            }
                                
                        ?>
                        <style>
                            #input{
                                padding:10px;
                                font-size: 20px;
                                

                            }
                        </style>
                        <form action="actioneditdetails.php?courseid=<?=$courid?>" method="POST">
                            <b><div id='input'>
                            <label for="newcoursename">Enter new coursename:</label><br></div>
                        </b>
                            <input type="text" required name="newcoursename" value="<?php echo $coursename ?>"><br><br>
                            <b><div id='input'>
                            <label for="newcategory">Enter new category:</label><br></div>
                        </b>
                            <input type="text" required name="newcategory" value="<?php echo $category ?>"><br><br>
                            <b><div id='input'>
                            <label for="newdesc">Enter new description:</label><br></div>
                        </b>
                            <input type="text" required name="newdesc" value="<?php echo $desc ?>"><br><br>

                            <input type="submit" id="btn2" name="submit" style='padding: 6px;
  margin-top: 8px;
  margin-right: 16px;
  background: #ddd;
  font-size: 17px;
  border: none;
  cursor: pointer;
  margin:auto;
  display:block;
  font-weight: bold;'>
                        </form> 
                    </div>
                </main>
            </div>
        </div>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </body>
</html>
