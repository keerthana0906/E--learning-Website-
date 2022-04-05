<?php

include "config2.php";
session_start();
$courseid=$_GET['courseid'];
if (isset($_SESSION['logged']))
{
    $id=$_SESSION['pid'];
    $sql="SELECT * FROM login where personid=$id";
    $res=$con->query($sql);
    $row = $res->fetch_assoc();
    if($row['flag']==1){
        header('Location:editvideodetails.php?courseid='.$courseid);
    }
    $sql="SELECT * FROM map where personid=$id and courseid=$courseid";
    $res=$con->query($sql);
    if ($res->num_rows==0){
      header('Location:abt_course.php?courseid='.$courseid);
    }
}
else{
    header('Location:abt_course.php?courseid='.$courseid);
}

?>
<html>
  <head>
    <title>Course</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/styles.css"/>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link href='jquery-bar-rating-master/dist/themes/fontawesome-stars.css' rel='stylesheet' type='text/css'>
    <script src="jquery-3.0.0.js" type="text/javascript"></script>
    <script src="jquery-bar-rating-master/dist/jquery.barrating.min.js" type="text/javascript"></script>
    <script type="text/javascript">

        $(function() {
          $('.rating').barrating({
            theme: 'fontawesome-stars',
            onSelect: function(value, text, event) {
              // Get element id by data-id attribute
              var el = this;
              var el_id = el.$elem.data('id');

                // rating was selected by a user
                if (typeof(event) !== 'undefined') {
                  
                  var split_id = el_id.split("_");
                  var postid =<?php echo$_GET['courseid'] ?>;  // postid

                  // AJAX Request
                  $.ajax({
                          url: 'rating_ajax2.php',
                          type: 'post',
                          data: {postid:postid,rating:value},
                          dataType: 'json',
                          success: function(data){
                          // Update average
                          var average = data['averageRating'];
                          $('#avgrating_'+postid).text(average);
                        }
                        });
                    }
                }
            });
        });
      
    </script>
    <style>     
      .hero-section {
        height: 1000px;
        padding-left:50px;
        padding-right:50px;
        padding-top:20px;
        background-image: url('img/course.jpg');
      }
      .hero-text {
        text-align: left;
        padding-top:70px;
      }
      .hero-subtext{
        background-color:black;
      }
      .hero-text h2 {
        font-size: 60px;
        color:white;
        padding-left:40px;
        font-weight: 500;
      }
      .hero-text h4 {
        font-size: 30px;
        color:black;
        font-weight:3000;
        padding-left:40px;
      }
      .hero-text h5 {
        font-size: 20px;
        color:white;
        padding-left:40px;
        font-weight: 500;
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
      .w3-container,.w3-panel{padding:16px;
      }
      .w3-container:after
      {
        content:"";
        display:table;
        clear:both
      }
    </style>
  </head>

  <body class="sb-nav-fixed">
    <nav class="sb-topnav navbar bg-dark" style="position:fixed;">
      <a class="heading" href="disp_courses.php">Go Back to Courses Page</a>
      <a class="navbar-b" href="index.php">Home</a>
      
    </nav>
    
    <div class="content">

    <?php
      $userid = $_SESSION["pid"];
      
      $query = "SELECT * FROM courses where courseid=$courseid";
      $result = mysqli_query($con,$query);
      while($row = mysqli_fetch_array($result)){
    ?>
    <section class="hero-section">
      <div class="container">
        <div class="hero-text">
          <div class="hero-subtext">
              <h2><?php echo $row['coursename'] ?></h2>
              <h5>
              <?php
                // User rating
                $query = "SELECT * FROM map WHERE courseid=".$courseid." and personid=".$userid;
                $userresult = mysqli_query($con,$query) or die(mysqli_error());
                $fetchRating = mysqli_fetch_array($userresult);
                $rating = $fetchRating['rating'];

                // get average
                $query = "SELECT ROUND(AVG(rating),1) as averageRating FROM map WHERE courseid=".$courseid." AND rating>0";
                $avgresult = mysqli_query($con,$query) or die(mysqli_error());
                $fetchAverage = mysqli_fetch_array($avgresult);
                $averageRating = $fetchAverage['averageRating'];

                if($averageRating <= 0){
                    $averageRating = "No rating yet.";
                }
              ?>

            <!-- Rating -->
            <select class='rating' id='rating_<?php echo $courseid; ?>' data-id='rating_<?php echo $courseid; ?>'>
                <option value="1" >1</option>
                <option value="2" >2</option>
                <option value="3" >3</option>
                <option value="4" >4</option>
                <option value="5" >5</option>
            </select>
            <div style='clear: both;'></div>
            Average Rating : <span id='avgrating_<?php echo $courseid; ?>'><?php echo $averageRating; ?></span></h5>
              
            <!-- Set rating -->
            <script type='text/javascript'>
              $(document).ready(function(){
                  $('#rating_<?php echo $courseid; ?>').barrating('set',<?php echo $rating; ?>);
              });
            </script>
            <br>
          </div>
          <br><br>
          <div class="row">
          <?php
            }?>
          <?php
            $sql="select part from video where courseid='".$courseid."'";
            $result = $con->query($sql);

            if ($result->num_rows > 0) 
            {
                while($row = $result->fetch_assoc()) 
                {?>
                <div class="col-md-3.5" style="background-color:white;">
                  <div class="w3-container">
                    <a href="videopage.php?part=<?php echo $row["part"]?>&courseid=<?php echo$courseid ?>">
                      <img src="img/play.jpg" width="250" height="200">
                    </a>
                    <h4><?php  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PART-".$row["part"]?></h4>
                  </div>
                </div>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <?php
                }
            }
            else 
            {
                echo "0 results";
            }
          ?>
          </div>
      </div>
    </section>
    </div>
  </body>
</html>