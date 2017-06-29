
<!DOCTYPE html>



  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Sign Up Page</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/design.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Shrikhand" rel="stylesheet">
	
	<style>
.dropdown-submenu {
    position: relative;
}

.dropdown-submenu .dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -1px;
}
</style>	
	<style type="text/css" >
<!--
/* @group Blink */
.blink {
	-webkit-animation: blink .75s linear infinite;
	-moz-animation: blink .75s linear infinite;
	-ms-animation: blink .75s linear infinite;
	-o-animation: blink .75s linear infinite;
	 animation: blink .75s linear infinite;
}
@-webkit-keyframes blink {
	0% { opacity: 1; }
	50% { opacity: 1; }
	50.01% { opacity: 0; }
	100% { opacity: 0; }
}
@-moz-keyframes blink {
	0% { opacity: 1; }
	50% { opacity: 1; }
	50.01% { opacity: 0; }
	100% { opacity: 0; }
}
@-ms-keyframes blink {
	0% { opacity: 1; }
	50% { opacity: 1; }
	50.01% { opacity: 0; }
	100% { opacity: 0; }
}
@-o-keyframes blink {
	0% { opacity: 1; }
	50% { opacity: 1; }
	50.01% { opacity: 0; }
	100% { opacity: 0; }
}
@keyframes blink {
	0% { opacity: 1; }
	50% { opacity: 1; }
	50.01% { opacity: 0; }
	100% { opacity: 0; }
}
/* @end */
-->
</style>

	

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

<body style="background-color:#bdc3c7;">
   <div class="container">
    <div id="main-wrapper">
	   <center> <h2> Sign Up Form </h2>
	   <img src="img/boy with book.png" class="avatar">
	   </center>
	   
	   <form  class="myform" action="sign up.php" method="post">
	        <label><b>Username:</b></label><br>
			<input  name="username" type="text"  class="inputvalues"
			placeholder="Type username" required><br>
	        <label><b>Password:</b></label><br>
			<input  name="password" type="password"  class="inputvalues" 
			placeholder="Type password" required><br>
			<label><b>Confirm Password:</b></label><br>
			<input name="cpassword" type="password"  class="inputvalues"
			placeholder="Confirm password" required><br>
			<input name="submit_btn" type="submit" id="signup_btn"  value="Sign Up" ><br>
	        <input type="button" id="back_btn"  value="<< Back"><br>
	   </form>
		
		<?php
		$con=mysqli_connect('localhost','root','','skp12527');
		if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
		   if(isset($_POST['submit_btn']))
		   {
			   //echo '<script type="text/javascript"> alert("Sign Up button clicked")</script>';
		   
		       $username= $_POST['username'];
			   $password= $_POST['password'];
			   $cpassword= $_POST['cpassword'];
			   
			   if($password==$cpassword)
			   {
				   $query="select * from userinfo WHERE username='$username'";
				   $query_run = mysqli_query($con,$query);
				   
				   if(mysqli_num_rows($query_run)>0)
				   {
					 echo '<script type="text/javascript"> alert("User already exists. try another username ")</script>';					 
				   }else
				   {
					   $query="insert into userinfo values('$username','$password')";
					   $query_run = mysqli_query($con,$query);
					   
					   
					   if( $query_run)
					   {
						    echo '<script type="text/javascript"> alert("User registered ")</script>';
					   }
					   else
					   {
						  echo '<script type="text/javascript"> alert(" there is some error ")</script>';  
					   }
					   
				   }
			   }
			   
		   }   
		   
		?>
		
		
	</div>
    </div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	
	<script>
$(document).ready(function(){
  $('.dropdown-submenu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>
  </body>
</html>

