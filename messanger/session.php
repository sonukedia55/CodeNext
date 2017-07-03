<?php
session_start();
  if(isset($_POST['login'])){

    $_SESSION['id']=$_POST['id'];

    header('Location: messanger.php');
  }
 ?>
