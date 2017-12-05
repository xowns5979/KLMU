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
		<link rel="stylesheet" href="../assets/css/main.css" />
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
											echo '<a href="../logout.php" class="logo" align="right"><strong>LOGOUT</strong></a>';
										}
										else {
											echo '<a href="../login.php" class="logo" align="right"><strong>LOGIN</strong></a>';
										}
									?>
								</header>

							<!-- Content -->
								<section>
									<header class="main">
										<h1>Mechanical Engineering</h1>
									</header>
									<img src="../images/mechanic.png">
									<p><strong>학과장 인사말</strong></p>
									안녕하세요?
한국과학기술원 기계공학과에 오신 것을 환영합니다.
저희 학과는 1971년에 설립되어 대한민국 산업화의 주역을 담당한 인재들을 배출하여 왔습니다.
이제 산업화를 넘어서 새로운 대 전환기를 선도할 리더를 양성하기 위해 교수, 학생, 직원이 하나가 되어 정성과 노고를 다하고 있습니다.
세계의 학생들이 와서 공부하고 싶어 하고, 세계의 기업들이 함께 연구하고 싶어 하는 기계공학과가 되려고 합니다.
우리의 학생들이 불확실성이 확대되는 환경에서 잘 적응하고, 실패에 강한 내성을 가진 인재로 성장하며 자기 주도적이고 창의적인 도전정신이 충만하도록 키우겠습니다.
이를 위해서 다양한 경험을 통하여 시야를 넓혀주고, 큰 흐름을 읽는 훈련을 통해서 리더십을 키우겠습니다. 또한, 사회에서 존경 받는 품격 있고 예절 바른 인재가 되도록 가르치겠습니다.
대학은 꿈을 파는 곳입니다. 인류사회에 기여하고 시대정신에 부응할 수 있는 큰 꿈과 비전을 제시하는 연구를 수행하겠습니다.
저희가 세계적인 기계공학과로 성장할 수 있도록 관심과 지원을 주시길 희망하오며 여러분의 기대에 부응하는 학과가 되기 위해 최선을 다하겠습니다.
감사합니다.
<br><br>

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

											
											$interaction_query = "select lab_to_student_interest from interaction_status where department_id = $department";
											$result_interaction = mysqli_query($connect, $interaction_query);

											$row2 = mysqli_fetch_array($result_interaction);
											$interaction_count = $row2[0];


											if($department == "1"){
												echo "Department : ISYSE<br>";
												echo "*현재까지 <strong style='color: #f56a6a'>$interaction_count</strong><strong style='color: #f56a6a'>번</strong> ISYSE 연구실에서 학생의 게시물에 컨택하였습니다.";
											}
											else if($department == "2"){
												echo "Department : CS<br>";
												echo "*현재까지 <strong style='color: #f56a6a'>$interaction_count</strong><strong style='color: #f56a6a'>번</strong> CS 연구실에서 학생의 게시물에 컨택하였습니다.";
											}
											else if($department == "3"){
												echo "Department : EE<br>";
												echo "*현재까지 <strong style='color: #f56a6a'>$interaction_count</strong><strong style='color: #f56a6a'>번</strong> EE 연구실에서 학생의 게시물에 컨택하였습니다.";
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
										<li><a href="../index.php">Homepage</a></li>
										<li><a href="../lab_information.php">Lab Information</a></li>
										<li><a href="../lab_review.php">Lab Review</a></li>
										<li><a href="../student_applying_board.php">Student Applying Board</a></li>
										<li><a href="../lab_recruiting_board.php">Lab Recruiting Board</a></li>
										
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