<?php

////CONNECTION////////////////////////////////
$dbHost = "localhost";
$dbuser = "root";
$dbName = "userdb";
$dbPass = "pass";
$con = mysqli_connect($dbHost,$dbuser,$dbPass,$dbName);


function runQuery($query){
  global $con;
  return mysqli_query($con,$query);
}

//////////////////////////////////////////////

$reqtype = $_POST['action'];

if($reqtype=="fetchtest"){
  $testid = (int)$_POST['testid'];



}


 ?>
