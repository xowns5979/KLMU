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

							<!-- Content -->
								<section>
									<header class="main">
										<h1>Student Applying Board</h1>
									</header>

									

									<form method="post" action="student_applying_post.php">
										<input type='hidden' name='article_id' value="">
										<script>
											function sendIdPost(e1, e2, id_2){
												$(e2).attr("value", id_2);
												$(e1).submit();
											}
										</script>
										<table>
											<thead>
												<tr>
													<th>번호</th>
													<th>제목</th>
													<th>작성자</th>
													<th>날짜</th>
													<th>학과</th>
												</tr>
											</thead>
											<tbody>
												<?php 
													$article_query="select * from student_applying_post order by article_id DESC";
													$result_article=mysqli_query($connect, $article_query);
													if($result_article){
														while($row = mysqli_fetch_array($result_article)){
															$id = $row[0];

															$author = $row[2];
															$title = $row[3];
															$dept = $row[4];
															$date = $row[6];
															echo "<tr>";
															echo "<td>$id</td>";
															echo "<td><a href='#' onclick='sendIdPost(this.parentNode.parentNode.parentNode.parentNode.parentNode, this.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[1], $id);' style='border-bottom : none; color : #3d4449'>$title</td>";
															echo "<td>$author</td>";
															echo "<td>$date</td>";
															if($dept == 1){
																echo "<td>Isyse</td>";
															}
															else if($dept == 2){
																echo "<td>CS</td>";
															}
															else if ($dept == 3){
																echo "<td>EE</td>";
															}
															echo "</tr>";
														}
													}
													else {
														echo "article query failed!<br>";
													}
												?>
												
											</tbody>
										</table>

									</form>
									<?php 
										if($type == "1"){
											echo "<a href='student_posting.php' class='button'><p style='font-family: Culim;''>글쓰기</p></a>";
										}
									?>
									

									<ul class="pagination" align="center">
										<li><span class="button disabled">Prev</span></li>
										<li><a href="#" class="page active">1</a></li>
										<li><a href="#" class="page">2</a></li>
										<li><a href="#" class="page">3</a></li>
										<li><a href="#" class="page">4</a></li>
										<li><a href="#" class="page">5</a></li>
										<li><a href="#" class="button">Next</a></li>
									</ul>
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