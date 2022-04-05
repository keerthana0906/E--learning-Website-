<?php
$host="localhost";
$user="root";
$password="";
$db="project";
session_start();
$con=mysqli_connect($host,$user,$password,$db);
if (!isset($_SESSION['logged'])){
  header('Location:index.php');
}
$id=$_SESSION['pid']; 
?>

<!DOCTYPE html>
<head>
    <title>CHANGE PASSWORD</title>
    <style>
        body {
  background-image: url('img/book bg.jpg');
  background-repeat:no-repeat;
  background-size:1370px 700px;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
  line-height: 1.5;
  color: white;
}
button {
  background-color: black;
  color: white;
  padding: 14px 20px;
  margin-left: 500px;
  margin-top:-700px;
  border: none;
  cursor: pointer;
  width: 20%;
}

button:hover {
  opacity: 0.8;
}
.info{
    background-color: black;
  color: white;
  margin-top: 50px;
  margin-bottom:50px;
  margin-left:400px;
  margin-right:450px;
  padding: 20px;
  text-align:center;
 
}
.msg{
    background-color: yellow;
    text-align:center;
    margin-top: 70px;
    margin-bottom:50px;
    margin-left:400px;
    margin-right:450px;
    padding:10px;
    border-radius:20px;
    color:black;

}
.back{
  background-color:skyblue;
    margin-right:1300px;
    padding:5px;
  color:black;

}
    </style>

</head>
<body>
        <div class="back">
        <a class="back" href="profile.php">Back</a>
        </div>
 
				<div>
					<form action="#" method="POST">
                       <div class="info">
                        <label for="newp" ><b>Enter New Password</b></label></br>
                        <input type="text" class="last-s" placeholder="" name="newp">
                        </div>
                        <div class="info">
                        <label for="conp"><b>Confirm New Password</b></label></br>
                        <input type="text" class="last-s" placeholder="" name="conp">
                        </div>
						<button>GO</button>
					</form>
				</div>
            
           
          
<?php


if(isset($_POST['newp']))
{
    $newp=$_POST['newp'];
    $conp=$_POST['conp'];
    if(strcmp($newp,$conp)==0)
    {
        
        $sql="UPDATE `login` SET password='$newp' WHERE `personid`=$id";
      $result=mysqli_query($con,$sql );
      echo "<div class=\"msg\"><b>YOUR PASSWORD HAS BEEN SUCCESSFULLY CHANGED</b>
             </div>";
             echo "<a href=\"profile.php?id=$id>\"><button>BACK</button></a> ";
    
    }
    else
    {
      echo "<div class=\"msg\">Password in both the sections are not matching<br>
             <b> PLEASE TRY AGAIN</b>
      </div>";
      //echo "<a href=\"profile.php?id=$id>\"><button>TRY AGAIN</button></a> ";
        
    }

}
?>

</body> 
 </html>
