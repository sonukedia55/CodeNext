<?php
	//now creating the home page
	
	include "session.php";
	
	$user = '';
	
	if(!$_SESSION['name']){
		header('Location: login.php'); // Redirect to login if session not found
	}else{
		$user = $_SESSION['name']; //define variable user to the value of name
		
	}
	?>
<html>
<head></head>
<body>
	<h2 style="margin-top :50px ;">Hello, <?php echo $user;?> </h2><br>
	<form method="post" action="session.php">
		<input type="submit" value="Logout" name="Logout"/><br>
	</form>
</body>
</html>

