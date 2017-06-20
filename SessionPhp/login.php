<?php
	//creating login page
	
	include "session.php"; //for getting session details
	
	if(isset($_SESSION['name'])){
		header('Location: index.php');
	}
	//redirect to index page if login found
	
	?>

	<HTML>
	<HEAD></HEAD>
	<BODY>
		<h2 style="margin-top:50px;">Login Here</h2>
		<form method="post" action="session.php">
			<input type="text" placeholder="username" name="user"/><br>
			<input type="text" placeholder="Password" name="pass"/><br>
			<hr>
			<input type="submit" value="Login" name="login"/><br></form>
			
		</BODY>
			
</HTML>
			