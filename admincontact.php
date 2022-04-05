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
                            <style>
                            #highlightthis{background-color: #000;}
                            </style>
                            <a class="nav-link" href="admincontact.php" id="highlightthis">Messages</a>
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
                    <style>
                            #courses{
                                padding:15px;
                                  overflow: hidden;
                                  background-color: #f2f2f2;

                            }
                        </style>
                    <div>
                        <h2 id='courses'>Messages for Admin</h2>
                    <style>
                            
                    table {
                      font-family: arial, sans-serif;
                      border-collapse: collapse;
                      width: 100%;
                      font-size: 20px;
                    }
                    th
                    {
                        padding-top: 12px;
                          padding-bottom: 12px;
                          text-align: center;
                          background-color: black;
                          color: white;
                          border-bottom: 1px solid #ddd;
                          padding: 8px;
                    }
                    td{
                      
                      
                      text-align: center;
                      border-bottom: 1px solid #ddd;
                      
                        padding: 8px;
                     
                    }
                    tr:nth-child(even){background-color: #f2f2f2;} 
                    tr:hover {background-color: #ddd;}
                    
                        </style>
                        
                        <?php 
                            $query = "SELECT * FROM contact";
                            echo '<table> 
                                <tr> 
                                    <th> <font face="Arial">Name</font> </th> 
                                    <th> <font face="Arial">Email</font> </th> 
                                    <th> <font face="Arial">Subject</font> </th> 
                                    <th> <font face="Arial">Message</font> </th> 
                                    
                                </tr>';


                            
                            if ($result = $mysqli->query($query)) {
                                while ($row = $result->fetch_assoc()) {
                                    $name = $row["name"];
                                    $email = $row["email"];
                                    $subject = $row["subject"];
                                    $message = $row["message"];
                                    
                            
                                    echo '<tr> 
                                            <td>'.$name.'</td> 
                                            <td>'.$email.'</td> 
                                            <td>'.$subject.'</td> 
                                            <td>'.$message.'</td> 
                                            
                                        </tr>';
                                }
                                $result->free();
                            } 
                            ?>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </body>
</html>