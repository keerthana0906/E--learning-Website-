<?php
		$con=mysqli_connect('localhost','root','','project');
		if(isset($_POST['cname']))
    	{
			$name=$_POST['cname'];
     		$email=$_POST['cemail'];
     		$subject=$_POST['subject'];
	    	$message=$_POST['message'];
      		$sql="insert into contact values('".$name."','".$email."','".$subject."','".$message."')";
			$result=mysqli_query($con,$sql);
			
		}
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<title>E-learning system</title>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<link rel="stylesheet" href="css/style.css"/>
		<style>
			.site-btn {
				display: inline-block;
				min-width: 20px;
				text-align: center;
				border: none;
				width: 30%;
				padding: 15px 10px;
				font-weight: 600;
				font-size: 16px;
				position: relative;
				color: #fff;
				cursor: pointer;
				background: #d82a4e;
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
						<nav class="main-menu">
							<ul>
								<li><a href="index.php" >Home</a></li>
								<li><a href="team.html" >Our Team</a></li>
							</ul>
						</nav>
					</div>

				</div>
			</div>
		</header>
		
		<div class="page-info-section set-bg" style="height: 200px"data-setbg="img/bg.jpg"></div>

		<section class="contact-page">
			<div class="container">
				<div class="row">

					<div class="col-lg-8">
						<br>
						<div class="contact-form-warp">

							<div class="section-title text-white text-left">
								<h2>Get in Touch</h2>
							</div>

							<form class="contact-form" method="POST" action='#'>
								<input type="text" placeholder="Your Name" name="cname"><br>
								<input type="text" placeholder="Your E-mail" name="cemail"><br>
								<input type="text" placeholder="Subject" name="subject"><br>
								<textarea placeholder="Message" name="message"></textarea><br><br>
								<button class="site-btn" type="submit" onclick="myFunction()">Send Message</button>
								<script>
									function myFunction() {
									alert("Message successfully sent !");
									}
								</script>
							</form>
							
						</div>
					</div>

					<div class="col-lg-4">
						<div class="contact-info-area">

							<div class="section-title text-left p-0">
								<h2>Contact Info</h2>
							</div>

							<div class="phone-number">
								<span>Direct Line</span>
								<h4>+00000000000000</h4>
							</div>

							<ul class="contact-list">
								<li>IIITDM Kancheepuram<br>Vandalur - kelambakkam Road</li>
								<li>+00000000000000</li>
								<li>iiitdm@gmail.com</li>
							</ul>

						</div>
					</div>
				</div>
			</div>
		</section>
	
		<footer >
			<div class="footer-bottom">
				<div class="footer-warp">
					<div class="copyright">
						Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved. | This website is made by IIITDM 2018 Batch.</a>
					</div>
				</div>
			</div>
		</footer> 
	
		<script src="js/jquery-3.2.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/main.js"></script>
	</body>
</html>