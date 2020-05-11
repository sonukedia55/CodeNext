<?php
$con = mysqli_connect("localhost","root","","userdb"); //server,user,password, database

$query = "Select * from tableuser";

//Accepting Post Request
if(isset($_POST['PersonName'])&&isset($_POST['PersonAge'])){
  $name = $_POST['PersonName'];
  $age = $_POST['PersonAge'];
  $qr2  = mysqli_query($con,"insert into tableuser values(NULL,'$name','$age')");
  if($qr2) echo "Added"; else "Failed";
}

$var1 = mysqli_query($con,$query);    //it will return an arry $var1 with fetch data
mysqli_close($con);


 ?>
<!DOCTYPE html>
<html
<body>
<h1>Person Table</h1>
<table>
<?php
  while($r=mysqli_fetch_array($var1)){
    echo '<tr><td>'.$r['PersonID'].'</td><td>'.$r['PersonName'].'</td><td>'.$r['PersonAge'].'</td></tr>';
  }
 ?>
</table>
<form method="post" action="#">
  <input name="PersonName" />
  <input name="PersonAge" />
  <input type="submit" value="Save"/>
</form>
</body>
</html>
