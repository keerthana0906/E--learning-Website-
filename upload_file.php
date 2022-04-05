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
$courid=$_POST['cId'];
$partnum=$_POST['partn'];
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$target_file=$target_dir . $courid ."_". $partnum .".". $FileType;
$query = "SELECT * FROM video where courseid=$courid AND part=$partnum";
$result = $mysqli->query($query);
$row=mysqli_num_rows($result);
if(!$row){
    echo "gjn";
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $query1="INSERT INTO video VALUES ('$courid', '$partnum', '$target_file')";
        if($mysqli->query($query1)==TRUE){
            header('Location: editvideodetails.php?courseid='.$courid);
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
else{
    echo "Sorry, there was an error uploading your file.";
}
?>