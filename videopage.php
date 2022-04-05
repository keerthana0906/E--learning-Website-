<?php
session_start();
?>
<?php
$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";
    /* $_SESSION['part']=1; */
    
    $courseid=$_GET['courseid'];
    $conn = new mysqli($servername, $username, $password, $dbname);
    if (isset($_SESSION['logged']))
  {
      $id=$_SESSION['pid'];
      $sql="SELECT * FROM login where personid=$id";
      $res=$conn->query($sql);
      $row = $res->fetch_assoc();
      if($row['flag']==1){
          header('Location:editvideodetails.php?courseid='.$courseid);
      }
      $sql="SELECT * FROM map where personid=$id and courseid=$courseid";
      $res=$conn->query($sql);
      if ($res->num_rows==0){
      header('Location:abt_course.php?courseid='.$courseid);
    }
  }
  else{
      header('Location:abt_course.php?courseid='.$courseid);
  }
    $sql="select coursename from courses where courseid='".$courseid."'";
    $result = $conn->query($sql);
    $row=$result->fetch_assoc();
?>
<html>
<head>
<link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <br>

<style>
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}
.w3-container,.w3-panel{padding:0.01em 16px}
.w3-container:after
{content:"";display:table;clear:both}

                            #courses{
                                padding:15px;
                                  overflow: hidden;
                                  background-color: #f2f2f2;
                                  font-color:black;
                                  font-family: arial, sans-serif;
                            }

</style>

</head>

<body class="w3-container">
<h2 id="courses">Course : <?php echo$row['coursename']?></h2>
<h2 id="courses">Part : <?php echo$_GET['part']?></h2>
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";
    /* $_SESSION['part']=1; */
    
    $courseid=$_GET['courseid'];
    $part=(int)$_GET["part"];
    
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql="select vidsrc from video where courseid='".$courseid."' and part='".$part."'";
    $result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        ?>
       <div class="imgcontainer">
<video width="800"controls>
  <source src=<?php echo$row["vidsrc"]?> type="video/mp4">
  Your browser does not support HTML5 video.
  </video>
  </div>
  <?php
    }
} else {
    echo "0 results";
}
?>
<div>
<button onclick="goBack()" style='padding: 6px;
  margin-top: 8px;
  margin-right: 16px;
  background: #ddd;
  font-size: 17px;
  border: none;
  cursor: pointer;
  margin:auto;
  display:block;
  font-weight: bold;'>Go Back</button>
</div>
</body>
<script>
function goBack() {
  window.history.back();
}
</script>
</html>