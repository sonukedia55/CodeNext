
<?php
include 'session.php';

$result = '<ul reversed style="width:90%;">';
    $con = mysqli_connect('localhost','root','','messanger');
    $id = $_SESSION['id'];

    if(isset($_POST['send'])){
      if($id==1)
       $reci = 2;
      else
        $reci=1;

      $mess = $_POST['mess'];
      $sqli= mysqli_query($con,"INSERT into messages values('','$id','$reci','$mess')");

    }

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

 ?>
 <!DOCTYPE html>
<html>
<head>
  <style>
  *{
    margin:0px;
  }
  ul{
    list-style: none;

  }
  li{
    text-decoration: none;
    list-style: none;
    padding: 5px 10px;
    width:60%;
    margin: 10px 0px;
    min-height: 50px;
    border-radius: 3%;
    font-size: 25px;
    color: grey;
  }
  #my{
    float:right;
    background-color:lightgreen;

  }
  #his{

    float:left;
    background-color:lightblue;

  }
  </style>
<script  type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">

var auto_refresh = setInterval(function(){
$('#msg_show').load('msg_ref.php');
return false;}, 2000);

</script>
</head>
<body>
  <div id="msg_show" style="width:100%;float:left;min-height:500px;">

    <?php echo $result;?>
 </div>

 <div style="width:100%;float:right;">
   <form align="right" action="messanger.php" method="post" style="width:100%;">
     <input type="text" autofocus name="mess" placeholder="Write message.."/>
     <input type="submit" name="send" value="Send"/>
   </form>
 </div>


</body>
</html>
