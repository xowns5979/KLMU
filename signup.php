<?php
	session_start();	

	global $id;
	global $password;
	global $name;
	global $email;
	global $type;
	global $connect;

	$id = $_POST["id"];
	$password = $_POST["password"];
	$name = $_POST["name"];
	$email = $_POST["email"];
	$type = intval($_POST["type"]);
	$department = intval($_POST["department"]);

	$connect=mysqli_connect("localhost","root","rhfkffk23","klmu");
	if($connect != true) {
		exit('not connected');
	}

	function addToUserDatabase($id_2, $password_2, $type_2, $department_2, $name_2, $email_2){
		global $connect;
		global $name;
		global $type;
		global $department;

		$insert_query="";
		if($type_2 == 1){
			$insert_query="insert into student_account values (NULL, '$id_2', '$password_2', $type_2, $department_2, '$name_2', '$email_2')";
			$uniqueId_query = "select unique_id from student_account where id='$id_2'";
		}
		else if($type_2 == 2){
			$insert_query="insert into lab_account values (NULL, '$id_2', '$password_2',$type_2, $department_2, '$name_2', '$email_2')";
			$uniqueId_query = "select unique_id from lab_account where id='$id_2'";
		}
		$result=mysqli_query($connect, $insert_query);

		$result_unique = mysqli_query($connect, $uniqueId_query);
		$row = mysqli_fetch_array($result_unique);
		$unique_id2 = $row[0];

		if($result){
			$_SESSION['islogin'] = "logged_in";
			$_SESSION['username'] = $name;
			$_SESSION['unique_id'] = $unique_id2; 
			$_SESSION['type'] = $type;
			$_SESSION['department'] = $department;
			return true;
		}
		else {
			return false;
		}
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
								<section align="">
									<header class="main">
										<h1>SIGN UP</h1>
									</header>
									<!-- Elements -->
										<div class="row 200%">
											<div class="6u$ 12u$(medium)">
												<!-- Form -->
												
												<form method="post" action="signup.php">
													
														<div class="6u 12u$(xsmall)">
															<input type="text" name="id" id="demo-name" value="" placeholder="ID" required/>
														</div>
														<br>
														<div class="6u$ 12u$(xsmall)">
															<input type="password" name="password" id="demo-email" value="" placeholder="Password" required/>
														</div>
														<br>
														<div class="6u$ 12u$(xsmall)">
															<input type="text" name="name" id="demo-email" value="" placeholder="Name" required/>
														</div>
														<br>
														<div class="6u$ 12u$(xsmall)">
															<input type="text" name="email" id="demo-email" value="" placeholder="E-mail" required/>
														</div>
														<br>
														<div class="row">
															<div class="3u 12u$(small)">
															
																<div class="4u 12u$(small)">
																	<input type="radio" id="demo-priority-low" name="type" value="1" checked>
																	<label for="demo-priority-low">Student</label>
																</div>
																<div class="4u 12u$(small)">
																	<input type="radio" id="demo-priority-normal" name="type" value="2">
																	<label for="demo-priority-normal">Lab</label>
																</div>
															</div>
															<div class="3u 12u$(small)">
															
																<div class="4u 12u$(small)">
																	<input type="radio" id="demo-priority-low2" name="department" value="1" checked>
																	<label for="demo-priority-low2">Isyse</label>
																</div>
																<div class="4u 12u$(small)">
																	<input type="radio" id="demo-priority-normal3" name="department" value="2">
																	<label for="demo-priority-normal3">CS</label>
																</div>
																<div class="4u 12u$(small)">
																	<input type="radio" id="demo-priority-normal4" name="department" value="3">
																	<label for="demo-priority-normal4">EE</label>
																</div>
															</div>
														</div>
														<!-- Break -->
														<div class="12u$">
															<ul class="actions">
																<li><input type="submit" value="　　　　　　SIGN UP　　　　　　　" class="special" /></li>
															</ul>
														</div>
														
												</form>
											</div>
										</div>
								</section>

						</div>
					</div>
					<?php

						if($_POST['id'] !="" and $_POST['password'] !=""){

							$isSaved = addToUserDatabase($id, $password, $type, $department, $name, $email);
							if($isSaved){
								header("Location: index.php");
								exit();
							}	
							else {
								$checkid_query_student = "select id from student_account where id = '$id'";
								$checkid_query_lab = "select id from lab_account where id = '$id'";
								
								$result_id_student = mysqli_query($connect, $checkid_query_student);
								$result_id_lab = mysqli_query($connect, $checkid_query_lab);
								if($row = mysqli_fetch_array($result_id_student)){
									echo "<script>";
									echo 'alert("존재하는 아이디입니다.")';
									echo "</script>";
								}
								else if ($row = mysqli_fetch_array($result_id_lab)){
									echo "<script>";
									echo 'alert("존재하는 아이디입니다.")';
									echo "</script>";
								}
								else{
									echo "<script>";
									echo 'alert("잘못된 회원정보입니다.")';
									echo "</script>";
								}	
							}
						}
					
					?>
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