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

<?php
	$con=mysqli_connect('localhost','root','','project');
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Personal info</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
  </head>

  <body class="sb-nav-fixed">
    <?php $id=$_SESSION['pid']; 
      $res=mysqli_query($con,"SELECT * FROM `profile` WHERE `personid`='$id'");
      $x=$res->fetch_assoc();
    ?>
    <nav class="sb-topnav navbar  navbar-dark bg-dark">
      <a class="heading" href="profile.php?id=<?php echo $id?>>">Back</a>
      <a class="nav_s"></a>
      <a class="navbar-b" href="index.php">Home</a>
      <a class="navbar-b" href="contact.php">Contact</a>
    </nav>
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
            <?php $id=$_SESSION['pid']; 
              $res2=mysqli_query($con,"SELECT * FROM `login` WHERE `personid`='$id'");
              $y=$res2->fetch_assoc();
              echo $y["username"];
            ?>
          </div>
        </nav>
      </div>
      <div id="layoutSidenav_content" >
        <main>
          <div>
            <ol class="breadcrumb mb-4" >
              <li class="breadcrumb-item"><a >Personal Info</a></li>
            </ol>
            <table id="t02">
              <tr>
                <th>Name :</th>
                <td><?php echo $x["name"];?></td>
              </tr>
              <tr>
                <th>User name :</th>
                <td><?php echo $y["username"];?></td>
              </tr>
              <tr>
                <th>Email :</th>
                <td><?php echo $x["email"];?></td>
              </tr>
              <tr>
                <th>College :</th>
                <td><?php echo $x["college"];?></td>
              </tr>
            </table>
          </div>
        </main>
      </div>
    </div>
  </body>
</html>