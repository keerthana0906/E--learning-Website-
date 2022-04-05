<?php

include "config2.php";
session_start();
$courseid=$_GET['courseid'];
if (isset($_SESSION['logged']))
{
    $justlogin=$_SESSION['pid'];
    $sql="SELECT * FROM login where personid=$justlogin";
    $res=$con->query($sql);
    $row = $res->fetch_assoc();
    if($row['flag']==1){
        header('Location:editcourse.php?courseid='.$courseid);
    }
}
?>
<!DOCTYPE html>
<html>

  <head>
    <title>About course</title> 
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <style>      
      .hero-section {
        
        padding-left:50px;
        padding-right:50px;
        padding-top:15px;
      }
      .hero-text {
        
        text-align: left;
        background-image: url('img/background.png');
      }

      .hero-text h2 {
        font-size: 60px;
        color:white;
        padding-left:40px;
        font-weight: 500;
        margin-bottom: 20px;
      }
      .contents {
        padding-left:40px;
        font-size: 20px;
        color:yellow;
        font-weight: 500;
        margin-bottom: 20px;
      }
      .descrip{
        padding-right:490px;
      }
      .contents p{
        color:white;
        font-weight:normal;
      }
      input[type=submit]
      {
        color:white;
        padding: 12px 20px;
        margin: 8px 0;
        background-color:crimson;
        border: none;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
      }
      #btn1{
        color:white;
        padding: 12px 20px;
        margin: 8px 0;
        background-color:crimson;
        border: none;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
      }

    </style>
  </head>

  <body class="sb-nav-fixed">
    <nav class="sb-topnav navbar  navbar-dark bg-dark">
      <a class="heading" href="disp_courses.php">Go Back to Courses Page</a>
      <a class="nav_s"></a>
      <a class="navbar-b" href="index.php">Home</a>
      <a class="navbar-b" href="contact.php">Contact</a>
    </nav>

    <?php
      $username = "root"; 
      $password = ""; 
      $database = "project"; 
      $mysqli = new mysqli("localhost", $username, $password, $database); 

      $courseid= $_GET['courseid'];

      function user_enroll($student_id, $course_id)
      {
        $username = "root"; 
        $password = ""; 
        $database = "project"; 
        $conn = new mysqli("localhost", $username, $password, $database);
        $stmt ='SELECT * FROM map WHERE personid='.$student_id.' AND courseid='.$course_id.'';

        $results = $conn->query($stmt);

        if($results->num_rows>0)
        {
            return true; 
        }
        else
        {
          return false; 
        }
      }

      $query = "SELECT * FROM courses where courseid=$courseid";
      $query2 = "SELECT COUNT(DISTINCT personid) FROM `map` WHERE courseid=$courseid";
      $result2 = $mysqli->query($query2);
      $result = $mysqli->query($query);
      if ($result->num_rows>0) 
      {
        while ($row = $result->fetch_assoc()) 
        {
          $coursename = $row["coursename"];
          $category = $row["category"]; 
          $courseid=$row["courseid"];
          $description=$row["description"];
   ?>
      <section class="hero-section">
		    <div class="container">
			    <div class="hero-text ">
            <h2><?php echo $coursename ?></h2>
            <div class="contents">

              <?php
                $query = "SELECT ROUND(AVG(rating),1) as averageRating FROM map WHERE courseid=".$courseid."";
                $avgresult = mysqli_query($con,$query);
                $fetchAverage = mysqli_fetch_array($avgresult);
                $averageRating = $fetchAverage['averageRating'];
              ?>

              Average Rating : <span id='avgrating_<?php echo $postid; ?>'><?php echo $averageRating; ?></span>
              <p>Category : <?php echo $category ?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

              <?php
                  }
                  $result->free();
                } 
                if ($result2->num_rows>0) 
                {
                  while ($row = $result2->fetch_assoc()) 
                  {
                    $count=$row["COUNT(DISTINCT personid)"];
                  }
                  $result2->free();
                } 
              ?>
      
              <p>Enrolled students : <?php echo $count ?></p>
              <div class="descrip"><p>Course Description :<br>&nbsp&nbsp&nbsp <a style="font-size: 17px;color:white;"><?php echo $description ?></a></p></div>
              <?php 
              if (isset($_SESSION['logged'])){
              if(user_enroll($justlogin,$courseid))
              {?>
                <button onclick="location.href='goto_course.php?courseid=<?=$courseid?>'" class="site-btn header-btn" id="btn1">Go to course</button>
              <?php }

              else { ?>
                <form  method="post">
                  <input type='submit' name='enrol' id='enrol' value="Enrol"/>
                </form>
                <?php if (isset($_POST['enrol'])) 
                {
                  $query = "SELECT MAX(id) as id FROM map";
                  $result = $mysqli->query($query);
                  $row=mysqli_fetch_array($result);
                  $courid=$row['id'];
                  $courid=$courid+1;
                  if($query2 =mysqli_query($mysqli,"INSERT INTO map(id, courseid, personid) values ($courid,$courseid,$justlogin) ")){
                    header('Refresh: 0');
                  }
                }?> 
              <?php } }
              else{?>
                <form  method="post">
                  <input type='submit' name='logenrol' id='enrol' value="Login to Enrol"/>
                </form>
              <?php
              if (isset($_POST['logenrol'])){
                header('Location:index.php');
              }        
              ?>
              <?php } ?>
              <br>
            </div>
			    </div>
		    </div>
      </section>
  </body>
</html>