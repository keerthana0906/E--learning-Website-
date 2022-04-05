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
$courid=$_GET['courseid'];
$que1 = "DELETE FROM courses where courseid=$courid ";
$que2 = "DELETE FROM map where courseid=$courid ";
$que3="SELECT  * from video where courseid=$courid";
$result=$mysqli->query($que3);

while($row = mysqli_fetch_array($result))
{
    $path=$row['vidsrc'];
    unlink($path);    
}
$que4="DELETE FROM video where courseid=$courid";
$res=$mysqli->query($que1);
$res=$mysqli->query($que2);
$res=$mysqli->query($que4);
echo "Done";
header('Location: index.php');
?>