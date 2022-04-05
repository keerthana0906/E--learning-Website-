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
$partn=$_GET['partnum'];
$query = "SELECT * FROM video where courseid=$courid AND part=$partn";
if($result=$mysqli->query($query)){
    $row = mysqli_fetch_array($result);
    $path=$row['vidsrc'];
    echo $path;
    if(unlink($path)){
        $sql="DELETE FROM video where courseid=$courid AND part=$partn";
        echo "file deleted";
        if($res=$mysqli->query($sql)){
            echo "record deleted";
            header('Location: editvideodetails.php?courseid='.$courid);
        }
    }
    else{
        echo "Error";
    }
}
?>