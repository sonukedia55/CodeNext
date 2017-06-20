<?php

	session_start(); //Start a session
	
	$con = mysqli_connect("localhost","root","","sessionphp"); //Connect to DB
	
	if(isset ($_POST['login'])){
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		
		$ddf = mysqli_query($con, "SELECT name FROM users WHERE username='$user' AND password='$pass'");
		{
			while($r = mysqli_fetch_array($ddf)){
				
				$_SESSION['name'] = $r['name'];				//Session define to store name
				
				header('Location: index.php'); //To redirect to index page if logged in_array
				
			}
		}
		header('Location: login.php'); //TO redirect if login in fails
		
	}
	
	if(isset($_POST['Logout'])){
		//to destory session on logout
		session_destroy();
		header('Location: login.php');
	}
	

?>