<?php
include 'session.php';

$result = '<ul reversed style="width:90%;">';
    $con = mysqli_connect('localhost','root','','messanger');
    $id = $_SESSION['id'];

    $df= mysqli_query($con,"SELECT * from (SELECT  * FROM messages WHERE reci = '$id' OR sender ='$id' ORDER BY id DESC LIMIT 6) q ORDER BY id");
    {
        while($r = mysqli_fetch_array($df)){
          if($r['sender']==$id){
            $result.='<li id="my"><u style="font-size:15px">you : </u> '.$r['mess'].'</li>';
          }
          if($r['reci']==$id){
            $result.='<li id="his"><u style="font-size:15px">sam :</u> '.$r['mess'].'</li>';
          }
        }

    }
$result.='</ul>';
echo $result;

 ?>
