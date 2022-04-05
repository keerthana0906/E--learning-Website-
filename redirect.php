<?php
$host="localhost";
$user="root";
$password="";
$db="project";
session_start();
$con=mysqli_connect($host,$user,$password,$db);
if (isset($_SESSION['logged'])){
    $pid=$_SESSION['pid'];
    $sql="SELECT * from login where personid='$pid'";
    $res=mysqli_query($con,$sql);
    $row=$res-> fetch_assoc();
    if($row['flag']==1){
        header('Location:adminindex.php');
    }
    else{
        header('Location:profile.php');
    }
}
else{
    header('Location:index.php');
}
?>