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
										<h1>Computer Science</h1>
									</header>
									<img src="../images/computer.png">
									<p><strong>Foundations / 전산기반학문</strong></p>
									이론: 전산이론분야는 모든 전산학 연구분야의 이론적인 모델과 분석의 틀을 제공하는 기본적이고 중요한 분야로서 알고리즘, 계산기하학, 프로그래밍 언어, 컴파일러 등의 세부 연구 분야를 포함한다. 알고리즘 분야는 컴퓨터로 문제를 해결하는 기법인 알고리즘의 디자인과 알고리즘의 성능과 정확성 및 문제의 복잡도를 분석하는 연구분야 이며, 계산기하학 분야는 이 중에서 특히 기하학적인 문제의 복잡도 및 알고리즘을 연구한다. 프로그래밍 언어 및 컴파일러 분야에서는 소프트웨어의 설계 단계부터 개발 및 유지 보수까지 전 단계에 걸쳐서, 프로그램을 분석하고 최적화하여 사용자가 보다 안전하고 편리하며 빠른 소프트웨어를 사용할 수 있도록 돕는 연구를 수행한다.

시스템: 시스템분야는 컴퓨팅의 실험적 기반학문이 되는 분야로 컴퓨터 구조, 운영체제, 네트워크, 임베디드 시스템, 실시간 시스템 등의 세부분야를 포괄하며 특히 산업체에서 가장 많이 필요로 하는 연구를 다룬다. 카이스트 전산학과는 우수한 전통적인 시스템 연구 역량을 바탕으로 최신 연구 동향인 사용자 경험 중심의 새로운 모바일 시스템, 물리적 현상과 시스템 기술이 융합된 사이버-피지컬(cyber-physical) 시스템, 클라우드 컴퓨팅 시스템에서도 세계 수준의 연구 성과를 이루어 내고 있다. 이와 더불어 유무선 네트워크 기술 또한 급격하게 발전하는 소셜 컴퓨팅의 발전에 발 맞추어 새로운 분야를 개척해 나가고 있다.
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