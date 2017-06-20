<?php
//how to connect to mysql
$database_name="diary";
$mysql_username="root";
$mysql_password='';
$server_name="localhost";

$con = mysqli_connect($server_name,$mysql_username,$mysql_password,$database_name);

if(isset($_POST['enter'])){ // it is how you can call a post function
	
	$date=$_POST['date'];
	$sub= $_POST['subject'];
	$entry= $_POST['entry'];
	
	$sql = mysqli_query($con,"insert into diary1 values('','$date','$sub','$entry')");
	//it is how you can insert the post variable to the table diary1 and in values('' <= it is for id auto-increment
	
}

//now we can fetch details from table
//for storing the details we define $content;
$content='';

$ddf= mysqli_query($con,"SELECT id,date,subject,entry FROM diary1 order by date");
{
	while($r = mysqli_fetch_array($ddf)){ 
				// this will fetch the details from table one by one till end of table order by date
			
			$date= $r['date'];  //we define variable date to store fetched date
			$subject=$r['subject'];
			$entry =$r['entry'];
			//now we will add all the gained as table by using (.) dot to combined html to php
			$content.='<tr><td>'.$date.'</td><td>'.$subject.'</td><td>'.$entry.'</td></tr>';
			
	}
}

?>
<!Doctype html>
<html>
<head>
<style>
td{border:solid 1px black;}
</style>
</head>
<body>
<div style="width:100%; text-align:center;">
	<form method="post" action="index.php"> <!--if you want to send the variable of form to another page then you can give the page name-->
		<input type="text" name="date" placeholder="YYYY-MM-DD" /><br>
		<input type="text" name="subject" placeholder="subject"/><br>
		<textarea name="entry" placeholder="entry" style="width:200px; height:200px;"></textarea><br>
		<input type="submit" name="enter" value="Add" /></form>
		
		
		<br><hr><br>
	
		
		<table align="center">
				<!--now we need to show the gained table here-->
				<?php echo $content;?>
			 </table>

</body></html>

