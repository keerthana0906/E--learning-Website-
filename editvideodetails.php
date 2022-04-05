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
                            <a class="nav-link" href="adminindex.php">Admin Dashboard</a>
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
                        
                        <?php
                        $courid=$_GET['courseid'];
                        ?>
                        <h2 style='padding-left:20px'>Add a new video</h2>
                        <form enctype="multipart/form-data" action="upload_file.php" method="POST">
                            <b style='padding-left:20px'>Browse for file to upload:</b><br>
                            <input name="file" type="file" id="file" size="80" required style='padding: 6px;
  margin-top: 8px;
  margin-right: 16px;
  background: #ddd;
  font-size: 17px;
  border: 1px;
  cursor: pointer;
  
  display:block;'><br>
  <style>
                            input[type=number] {
                            width: 50%;
                            padding: 12px 20px;
                            
                            margin: 20px 0;
                            box-sizing: border-box;
                            margin:auto;
                            }
                            
                            
                        </style>
                            <input type="hidden" id="cId" name="cId" value="<?php echo $courid ?>">
                            <input type="number"  id="partn" name="partn" required placeholder="Enter which part" ><br>
                            <input type="submit"  id="u_button" name="u_button" value="Upload the file" style='padding: 6px;
  margin-top: 8px;
  margin-right: 16px;
  background: #ddd;
  font-size: 17px;
  border: 1px;
  cursor: pointer;
  display:block;
  font-weight: bold'>
                        </form>
                    </div>
                    <div>
                        <h2 style='padding-left:20px'>Uploaded videos</h2>
                        <?php
                            $sql="SELECT  * from video where courseid=$courid order by part";
                            $result=$mysqli->query($sql);

                            while($row = mysqli_fetch_array($result))

                            {
                        ?>
                            <!-- A division tag from here to here is appresciated -->
                            <a>
                            <br>
                            <video width="300" height="200" controls>
                            <source src="<?php echo $row['vidsrc']; ?>" type="video/mp4">
                            </video> <br>
                            <button type="button" onclick="location.href='removevideo.php?courseid=<?=$courid?>&partnum=<?php echo $row['part']; ?>'">Part <?php echo $row['part']; ?>
                            X</button>
                            </a>
                            <!-- Till here :) -->
                            <?php } ?>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </body>
</html>