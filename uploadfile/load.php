<?php

  $filename = $_POST['filename'];

  $target_directory = "files/";
  $target_file = $target_directory.basename($_FILES["file"]["name"]);   //name is to get the file name of uploaded file
  $filetype = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $newfilename = $target_directory.$filename.".".$filetype;

  //move_uploaded_file($_FILES["file"]["tmp_name"],$newfilename);   // tmp_name is the file temprory stored in the server

  //Now to check if uploaded or not

  if(move_uploaded_file($_FILES["file"]["tmp_name"],$newfilename)) echo 1;
  else echo 0;


 ?>
