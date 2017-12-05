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
										<h1>Mathmatical Sciences</h1>
									</header>
									<img src="../images/math.png">
									<p><strong>기하학 (Geometry)</strong></p>


미분다양체론, 리만기하학의 기본 지식을 바탕으로 하여 핀칭(pinching), 곡률과 작용 (actions), 닫힌 측지선, 유한성 정리, 비교정리, 기하구조, 등장매몰(isometric immersions), 조화사상 및 비선형 문제 등의 연구에 중점을 둔다.<br><br>
									<p><strong>해석학 및 응용수학 (Analysis and Applied Mathematics)</strong></p>
상미분방정식, 편미분방정식, 조화해석학, 복소함수론, 적분방정식, 작용소 이론 등과 응용 과학에서 제기되는 해석적 문제에 대한 연구를 수행하며, 이러한 연구 결과들을 자연과학, 공학에 응용하여 실제적 문제를 수학적으로 분석하여 해결하는 데에 중점을 둔다. 실제적 예로, Radon Transform을 이용한 CT 촬영기술, Wavelet을 이용한 영상 및 신호처리 기법 등은 이와 같은 해석학 이론의 중요한 응용이다.<br><br>
									<p><strong>위상수학 (Topology)</strong></p>
다양체의 구조와 성질을 대수적, 기하적, 조합수학적 방법을 통하여 연구한다. 활발하게 연구되고 있는 분야로는 (i) 매듭, 고리, 땋임 및 3차원 다양체, (ii) 쌍곡 및 이산군 이론을 포함하는 저차원다양체의 기하구조, (iii) 사이버그-위튼 이론, 사교구조 및 접촉구조를 통한 4차원다양체의 연구, (iv) 미분다양체, 대수다양체 및 반대수 집합 상의 군의 작용을 통한 다양체의 대칭성 등이 있다. 아울러 컴퓨터 그래픽, 땋임군을 이용한 비가환 암호론으로의 응용이 효과적으로 이루어지고 있다.<br><br>
									<p><strong>대수학 및 정수론 (Algebra and Number Theory)</strong></p>
이론분야에서는 주로 가환 혹은 비가환 유체론과 관련된 문제들을 대수기하학, 정수론, 표현론 등을 사용해서 연구한다. 응용분야에서는 암호론, 부호론, 게임이론 등 컴퓨터나 사회과학분야에서 나오는 문제들을 대수기하학, 정수론, 선형대수 등을 사용해서 연구한다. 이론분야에서는 주로 가환 혹은 비가환 유체론과 관련된 문제들을 대수기하학, 정수론, 표현론 등을 사용해서 연구한다. 응용분야에서는 암호론, 부호론, 게임이론 등 컴퓨터나 사회과학분야에서 나오는 문제들을 대수기하학, 정수론, 선형대수 등을 사용해서 연구한다.<br><br>
									<p><strong>과학계산수학</strong></p>
자연과학 및 공학내의 이론적 분야인 열역학, 유체역학, 탄성역학, 전자기학, 신경계 등에서 제기되는 수학적 문제들을 수치적 기법을 병행하여 연구한다. 수리역학 분야의 수학적 문제들은 엄밀하고 깊은 수학적 배경 위에서 그 해석이 가능하다. 역사적으로 수리역학의 해석적 기초는 대부분 수학자들에 의해 세워졌고, 이러한 전통은 아직도 계속 되고 있다. 수리역학의 연구는 공학에서 제기되는 여러 가지 수학적 문제들의 분석과 응용에 직·간접적인 도움을 줄 수 있다. 또한, 복잡한 자연, 사회현상을 수치적으로 해석하기 위하여 수학적 방법, 즉 효과적인 계산 방법 및 오차해석, 근사이론 등을 연구한다. 해석학의 지식을 토대로 한 과학계산에 관한 이론적 연구와 자연과학, 공학 등의 연구에 직접 사용할 수 있는 계산방법의 개발에 관한 연구에 중점을 둔다. 복잡한 자연, 사회현상을 수학적으로 표현하고 이것을 수치적으로 풀기 위한 수학적 방법, 즉 이산화 및 효과적인 계산방법 및 오차해석, 근사이론 등을 연구한다.<br><br>
									<p><strong>조합론 (Combinatorics)</strong></p>
이산구조나 조합적 구조를 가진 수학적 대상을 조합론적 방법으로 연구하는 분야이다. 수학의 여러 분야에서 나타나는 조합론적 문제들을 연구하고 다양한 조합적 대상들에 대한 이론을 개발한다. 이 분야의 연구는 대수적 조합론, 그래프론, 개수세기, 순서집합 등에 중점을 둔다.<br><br>
									<p><strong>정보수학 (Information Security)</strong></p>
샤논의 정보이론, 계산 및 복잡도 이론, 호프만 코드, 엔트로피, 데이터 압축, 오류정정 부호, 암호론, 정보보호 등을 다룬다.<br><br>
									<p><strong>금융수학 (Financial Mathematics)</strong></p>
금융시장을 여러 가지 확률적분방정식, 또는 확률미분방정식으로 표현한 금융모델의 해를 계산하고 경제적인 주해를 소개한다. 실물시장의 구체적인 자료(data)를 이용하여 확률모델을 검증하고 시장의 움직임을 예측하는 기법을 다룬다.<br><br>
									<p><strong>확률 및 통계학 (Probability and Statistics)</strong></p>
자연 및 사회 현상을 측도론적 방법(Measure-theoretical method)으로 분석·이해하고 우연적 법칙을 발견하며, 제반 불확실성 문제를 다룰 수 있는 통계적 방법을 연구하는 분야인데, 타 학문분야와의 학제간 연구를 통하여 연구효과의 극대화를 추구한다. 확률분야에서는 일반 확률과정이론, Martingale, Markov chain, 확률미분방정식, Queueing 이론과 통신, 확률제어이론, 최적화이론, 전산에의 응용에 연구의 중점을 두고, 통계분야에서는 다변량 분석, 불완전자료 분석, 학습이론, 신경회로망모델, 추정론, 그래프모형론, 인공지능에의 통계적 기법 적용, 거대모형 개발법, 시계열 분석, 베이즈 분석에 연구의 중점을 둔다.<br><br>
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