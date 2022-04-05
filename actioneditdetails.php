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
if(isset($_POST['submit'])){
    $ncategory=$_POST['newcategory'];
    $ncoursename=$_POST['newcoursename'];
    $ndesc=$_POST['newdesc'];
    $courid=$_GET['courseid'];
    $query="DELETE FROM courses where courseid=$courid";
    $result = $mysqli->query($query);
    $query1="INSERT INTO courses VALUES ('$courid', '$ncoursename', '$ndesc', '$ncategory')";
    if($mysqli->query($query1)==TRUE){
        header('Location: editcourse.php?courseid='.$courid);
    }
    
}
?>