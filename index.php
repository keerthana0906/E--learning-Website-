<?php
    $host="localhost";
    $user="root";
    $password="";
    $db="project";
    session_start();
    $con=mysqli_connect($host,$user,$password,$db);
 
    if(isset($_POST['uname']))
    {
        $uname=$_POST['uname'];
        $password=$_POST['psw'];
        $res=mysqli_query($con,"select * from login where username='".$uname."' AND password='".$password."' limit 1");
        $id=$res-> fetch_assoc();
        
        if(mysqli_num_rows($res)==1)
        {
          $pid=$id["personid"];
          echo $pid;
          $_SESSION["pid"]=$pid;
          $_SESSION["logged"]=1;
          header("Location:index.php");
            
        }
        else
        {
          echo"<script>alert('Incorrect login details! Try again.');</script>"; 
          echo"<script>location.href='index.php'</script>"; 
          exit();
        }
    }

    if(isset($_POST['runame']))
    {
      $uname=$_POST['runame'];
      $password=$_POST['rpsw'];
      $email=$_POST['rmail'];
	    $college=$_POST['rclg'];
      $sql="insert into login(username,password) values('".$uname."','".$password."')";
      $result=mysqli_query($con,$sql);

      $res=mysqli_query($con,"select personid from login where username='$uname' AND password='$password'");
      $id=$res-> fetch_assoc();
      $pid=$id["personid"];
      $sql="insert into profile values('".$pid."','".$uname."','".$email."','".$college."')";
      $result=mysqli_query($con,$sql);

      //echo $pid;
      $_SESSION["pid"]=$pid;
      $_SESSION["logged"]=1;
      header("Location:index.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>WebLearn - E-Learning</title>
	<link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <style>
        input[type=text], input[type=password] 
        {
          width: 100%;
          padding: 12px 20px;
          margin: 8px 0;
          display: inline-block;
          border: 1px solid #ccc;
          box-sizing: border-box;
        }

        button 
        {
          background-color: #4CAF50;
          color: white;
          padding: 14px 20px;
          margin: 8px 10px;
          border: none;
          cursor: pointer;
          width: 20%;
        }

        button:hover 
        {
          opacity: 0.8;
        }

        .cancelbtn 
        {
          width: auto;
          padding: 10px 18px;
          background-color: #f44336;
        }
        .site-btn {
          display: inline-block;
          min-width: 20px;
          text-align: center;
          border: none;
          width: 20%;
          padding: 15px 10px;
          font-weight: 600;
          font-size: 16px;
          position: relative;
          color: #fff;
          cursor: pointer;
          background: #d82a4e;
        }
        .imgcontainer 
        {
          text-align: center;
          margin: 24px 0 12px 0;
          position: relative;
        }

        img.avatar 
        {
          width: 40%;
          border-radius: 50%;
        }

        .container 
        {
          padding: 16px;
        }

        span.psw 
        {
          float: right;
          padding-top: 16px;
        }

        .modal 
        {
          display: none; /* Hidden by default */
          position: fixed; /* Stay in place */
          z-index: 1; /* Sit on top */
          left: 0;
          top: 0;
          width: 100%; /* Full width */
          height: 100%; /* Full height */
          overflow: auto; /* Enable scroll if needed */
          background-color: rgb(0,0,0); /* Fallback color */
          background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
          padding-top: 30px;
        }

        .modal-content 
        {
          background-color: #fefefe;
          margin: 1% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
          border: 1px solid #888;
          width: 50%; /* Could be more or less, depending on screen size */
        }

        .close 
        {
          position: absolute;
          right: 25px;
          top: 0;
          color: #000;
          font-size: 35px;
          font-weight: bold;
        }

        .close:hover,
        .close:focus 
        {
          color: red;
          cursor: pointer;
        }

        /* Add Zoom Animation */
        .animate 
        {
          -webkit-animation: animatezoom 0.6s;
          animation: animatezoom 0.6s
        }

        @-webkit-keyframes animatezoom 
        {
          from {-webkit-transform: scale(0)} 
          to {-webkit-transform: scale(1)}
        }
        
        @keyframes animatezoom 
        {
          from {transform: scale(0)} 
          to {transform: scale(1)}
        }

        /* Change styles for span and cancel button on extra small screens */
        @media screen and (max-width: 300px) 
        {
          span.psw 
          {
            display: block;
            float: none;
          }
          .cancelbtn 
          {
            width: 100%;
          }
        }
  </style>
</head>

<body>
	<header class="header-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-3">
					<div class="site-logo">
						<img src="img/logo.png" alt="">
					</div>
				</div>
				<div class="col-lg-9 col-md-9">
        <?php
        if (isset($_SESSION['logged'])) {?>
          <button onclick="location.href='logout.php'" class="site-btn header-btn">Logout</button>
					<button onclick="location.href='redirect.php'" class="site-btn header-btn">Profile</button>
					
        <?php }
        else{ ?>
          <button onclick="document.getElementById('id01').style.display='block'" class="site-btn header-btn">Login</button>
					<button onclick="document.getElementById('id02').style.display='block'" class="site-btn header-btn">Register</button>
        <?php }?>
					<div id="id01" class="modal">
            <form class="modal-content animate" action="#" method="POST">
            <div class="imgcontainer">
                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                <img src="img/avatar.jpg" alt="Avatar" class="avatar">
              </div>
              <div class="container">
                <label for="uname"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="uname" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" required>
                  
                <button type="submit">Login</button>
              </div>

              <div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
              </div>
            </form>

				</div>

				<div id="id02" class="modal">
					<form class="modal-content animate"  method="POST">

						<div class="imgcontainer">
              <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
              <img src="img/avatar.jpg" alt="Avatar" class="avatar">
						</div>

						<div class="container">
              <label for="fname"><b>Name</b></label>
              <input type="text" placeholder="Enter Name" name="fname" required>
              
              <label for="runame"><b>Username</b></label>
              <input type="text" placeholder="Enter Username" name="runame" required>

              <label for="rpsw"><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="rpsw" required>
              
              <label for="rmail"><b>Email</b></label>
              <input type="text" placeholder="Enter email_id" name="rmail" required>
              
              <label for="rclg"><b>College</b></label>
              <input type="text" placeholder="Enter college name" name="rclg" required>
                
              <button type="submit">Register</button>
						</div>

						<div class="container" style="background-color:#f1f1f1">
              <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
						</div>
					</form>
				</div>

        <nav class="main-menu">
					<ul>
						<li><a href="disp_courses.php">Courses</a></li>
						<li><a href="contact.php">Contact</a></li>
					</ul>
				</nav>
			</div>
		</div>
	</header>
	
	<section class="hero-section set-bg" data-setbg="img/bg.jpg">
		<div class="container">
			<div class="hero-text text-white">
				<h2>Get The Best Online Courses</h2>
				<p>An exclusive website for IIITDM Kancheepuram</p>
			</div>
		</div>
  </section>
  
	<footer >
		<div>
			<div class="footer-warp">
				<div class="copyright">
					Copyright &copy;
          <script>document.write(new Date().getFullYear());</script> 
          <a>All rights reserved | This website is made by 2018 IIITDM batch</a>
				</div>
			</div>
	</footer>
	
	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>

</html>