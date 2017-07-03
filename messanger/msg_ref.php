<?php
include 'session.php';

$result = '<ul style="width:90%;">';
    $con = mysqli_connect('localhost','root','','messanger');
    $id = $_SESSION['id'];

    $df= mysqli_query($con,"SELECT sender,mess,reci FROM messages WHERE reci = '$id' OR sender ='$id' ORDER BY id DESC");
    {
        while($r = mysqli_fetch_array($df)){
          if($r['sender']==$id){
            $result.='<li id="my">'.$r['mess'].'</li>';
          }
          if($r['reci']==$id){
            $result.='<li id="his">'.$r['mess'].'</li>';
          }
        }

    }
$result.='</ul>';
echo $result;

 ?>
