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

<?php
$query = "SELECT MAX(courseid) as id FROM courses";
$result = $mysqli->query($query);
$row=mysqli_fetch_array($result);
$courid=$row['id'];
$courid=$courid+1;
echo $courid;
$sql="INSERT INTO courses VALUES ('$courid', '', '', '')";
$res=$mysqli->query($sql);
header('Location: editcoursedetails.php?courseid='.$courid);
?>