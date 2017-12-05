<?php
	session_start();	
	$islogin = $_SESSION['islogin'];
	$username = $_SESSION['username'];
	$unique_id = $_SESSION['unique_id'];
	$type = $_SESSION['type'];
	$department = $_SESSION['department'];

	$a = strcmp($islogin,'logged_in');

	$connect=mysqli_connect("localhost","root","rhfkffk23","klmu");

	if($connect == false) {
		echo "connection failed! <br>";
	}

	$visit_query = "select count from visit_count";
	$visitor_count;
	$result_visit=mysqli_query($connect, $visit_query);
	if($result_visit){
		if($row = mysqli_fetch_array($result_visit)){
			$visitor_count = $row[0];
			$insert_query = "update visit_count set count = count + 1";
			$result_insert = mysqli_query($connect, $insert_query);

		}
	}

	

?>
<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>KLMU</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<a href="index.php" class="logo"><strong>KLMU</strong>  KAIST LAB MATCHER for Undergraduate</a>
									<?php 
										if(!strcmp($islogin,'logged_in')){
											echo '<a href="logout.php" class="logo" align="right"><strong>LOGOUT</strong></a>';
										}
										else {
											echo '<a href="login.php" class="logo" align="right"><strong>LOGIN</strong></a>';
										}
									?>
								</header>

							<!-- Banner -->
								<section id="banner">
									<div class="content" align="center"> 
										<header>
											<h1>Kaist Lab Matcher</h1>
										</header>
										<p><strong align="center">학부생을 위한 연구실 매칭 시스템</strong></p>
										<p><strong>학부생들에게는</strong> : Easy solution to find a lab they have interest<br>
											<strong>연구실에게는</strong> : Easy solution to find an undergraduates who are willing to work</p>
										<ul class="actions">
											<li><a href="student_applying_board.php" class="button big"><p style="font-family: Culim;">학부생 게시판</p></a></li>
											<li><a href="lab_recruiting_board.php" class="button big"><p style="font-family: Culim;">연구실 게시판</p></a></li>
										</ul>
									</div>
									
								</section>

							
							<!-- Section -->
								<section>
									<div class="posts" align="center">
										<article>
											<h3>For Lab</h3>
											<p>직접 학부생 구인 글을 올리시거나, 학부생들이 올린 구직 글을 확인하세요!</p>
											<ul class="actions">
												<li><a href="lab_recruiting_board.php" class="button"><p style="font-family: Culim;">연구실 게시판</p></a></li>
												<li><a href="student_applying_board.php" class="button"><p style="font-family: Culim;">학부생 게시판</p></a></li>
											</ul>
										</article>
										<article>
											<h3>For Student</h3>
											<p>직접 구직 글을 올리시거나, 연구실에서 올린 구인 글을 확인하세요!</p>
											<ul class="actions">
												<li><a href="student_applying_board.php" class="button"><p style="font-family: Culim;">학부생 게시판</p></a></li>
												<li><a href="lab_recruiting_board.php" class="button"><p style="font-family: Culim;">연구실 게시판</p></a></li>
											</ul>
									</div>
								</section>

						</div>
					</div>

				<!-- Sidebar -->
					<div id="sidebar">
						<div class="inner">
							<!-- Status -->
								<section id="status" class="alt">
									<header class="major">
										<h2>Status</h2>
									</header>
									<?php 
										if(!strcmp($islogin,'logged_in')){
											echo "<strong>Hello, $username!</strong><br>";
											if($type == "1"){
												echo "(Student User)<br>";
											}
											else if($type =="2"){
												echo "(Lab User)<br>";
											}

											if($type == "1"){
												$interaction_query = "select lab_to_student_interest from interaction_status where department_id = $department";
											}
											else if($type == "2"){
												$interaction_query = "select student_to_lab_interest from interaction_status where department_id = $department";
											}
											$result_interaction = mysqli_query($connect, $interaction_query);

											$row2 = mysqli_fetch_array($result_interaction);
											$interaction_count = $row2[0];


											if($department == "1" && $type == "1"){
												echo "Department : ISYSE<br>";
												echo "*현재까지 <strong style='color: #f56a6a'>$interaction_count</strong><strong style='color: #f56a6a'>번</strong> ISYSE 연구실에서 학생의 게시물에 컨택하였습니다.";
											}
											else if($department == "2" && $type == "1"){
												echo "Department : CS<br>";
												echo "*현재까지 <strong style='color: #f56a6a'>$interaction_count</strong><strong style='color: #f56a6a'>번</strong> CS 연구실에서 학생의 게시물에 컨택하였습니다.";
											}
											else if($department == "3" && $type == "1"){
												echo "Department : EE<br>";
												echo "*현재까지 <strong style='color: #f56a6a'>$interaction_count</strong><strong style='color: #f56a6a'>번</strong> EE 연구실에서 학생의 게시물에 컨택하였습니다.";
											}
											else if($department == "1" && $type == "2"){
												echo "Department : ISYSE<br>";
												echo "*현재까지 <strong style='color: #f56a6a'>$interaction_count</strong><strong style='color: #f56a6a'>번</strong> ISYSE 학생이 연구실의 게시물에 컨택하였습니다.";
											}
											else if($department == "2" && $type == "2"){
												echo "Department : CS<br>";
												echo "*현재까지 <strong style='color: #f56a6a'>$interaction_count</strong><strong style='color: #f56a6a'>번</strong> CS 학생이 연구실의 게시물에 컨택하였습니다.";
											}
											else if($department == "3" && $type == "2"){
												echo "Department : EE<br>";
												echo "*현재까지 <strong style='color: #f56a6a'>$interaction_count</strong><strong style='color: #f56a6a'>번</strong> EE 학생이 연구실의 게시물에 컨택하였습니다.";
											}


										}
										else {
											echo '<strong>Could you Log-in first?</strong>';
										}
									?>
										
								</section>
								
							<!-- Menu -->
								<nav id="menu">
									<header class="major">
										<h2>Menu</h2>
									</header>
									<ul>
										<li><a href="index.php">Homepage</a></li>
										<li><a href="lab_information.php">Lab Information</a></li>
										<li><a href="lab_review.php">Lab Review</a></li>
										<li><a href="student_applying_board.php">Student Applying Board</a></li>
										<li><a href="lab_recruiting_board.php">Lab Recruiting Board</a></li>
										
										
									</ul>
									<br>
									<?php 
										echo "<text>사이트 방문자 수 : $visitor_count</text>"
									?>
								</nav>


						</div>
					</div>
			</div>
		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>