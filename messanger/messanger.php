
<?php
include 'session.php';

$result = '<ul style="width:90%;">';
    $con = mysqli_connect('localhost','root','','messanger');
    $id = $_SESSION['id'];

    if(isset($_POST['send'])){
      $reci = 2;
      $mess = $r['mess'];
      $sqli= mysqli_query($con,"INSERT into messages values('','$id','$reci','$mess')");

    }

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

 ?>
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
	$(function(){
var auto_refresh = setInterval(
function()
{
$('#msg_show').load('msg_ref.php');
return false;}, 2000);
});

</script>
</head>
<body>
  <div id="mes_show" style="width:100%;float:left;min-height:500px;">

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
