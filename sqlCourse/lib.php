<?php

$dbHost = "localhost";
$dbuser = "root";
$dbName = "userdb";
$dbPass = "pass";
$con = mysqli_connect($dbHost,$dbuser,$dbPass,$dbName); //server,user,password, database


function runQuery($query){
  global $con;
  return mysqli_query($con,$query);
}

 ?>
