<?php
	$con = mysqli_connect("localhost","root","","smartshop");

  $result='';
  $total=0;
  $cname='';
	$time='';

  if(isset($_POST['show'])){
    $id=$_POST['id'];
    $cid=0;
    $result.='<br><br><textarea type="text" id="itemhead" cols="20" rows="2" disabled>Item Name</textarea> <textarea name="piece" type="text"  cols="10" rows="2" id="itemhead" disabled>Piece</textarea><textarea type="text" id="itemhead" cols="10" rows="2" disabled> Price</textarea> <textarea type="text" id="itemhead" cols="10" rows="2" disabled>Cost</textarea><br><hr><br><br>';
    $ddf = mysqli_query($con, "SELECT  id,cname,time FROM user WHERE cid='$id'");
      {
      while($r = mysqli_fetch_array($ddf)){
        $cid=$r['id'];
        $cname=$r['cname'];
        $time=$r['time'];
      }
    }
    if($cid!=0){
    $ddf = mysqli_query($con, "SELECT  item,piece,cost,price FROM data WHERE id='$id'");
      {
      while($r = mysqli_fetch_array($ddf)){
        $item=$r['item'];
        $piece=$r['piece'];
        $cost=$r['cost'];
        $price=$r['price'];
        $total+=$cost;
        $result.='<textarea type="text" id="itemname" cols="20" rows="2" disabled>'.$item.'</textarea> <textarea name="piece" type="text"  cols="10" rows="2" id="itemname" >'.$piece.'</textarea><textarea type="text" id="itemname" cols="10" rows="2" disabled>x '.$price.'</textarea><textarea type="text" id="itemname" cols="10" rows="2" disabled>'.$cost.'</textarea><br>';

      }
    }
    }

  }
  if(isset($_POST['clean'])){

    $ddf = mysqli_query($con, "SELECT  uid FROM error");
      {
      while($r = mysqli_fetch_array($ddf)){
        $did=$r['uid'];
        $ddfl = mysqli_query($con, "SELECT  uid FROM data WHERE id='$did'");
          {
          while($rp = mysqli_fetch_array($ddfl)){
            $pid =$rp['uid'];
            $query = mysqli_query($con,"DELETE  FROM data WHERE uid='$pid'");

          }
        }
          $query = mysqli_query($con,"DELETE  FROM error WHERE uid='$did'");
      }

    }

  }

 ?>
<!DOCTYPE html>
<HTML>
  <head>
    <title>Smart Shop</title>
    <link href="style.css"  rel="stylesheet" />
    <style>
    ::-webkit-scrollbar {
        width: 0px;  /* remove scrollbar space */
        background: grey;  /* optional: just make scrollbar invisible */
    }
    ::-webkit-scrollbar-thumb {
    	width:0px;
      background: black;
    	border-radius:4%;
    }
    body{
      overflow-x: hidden;
    }
    </style>
    <script  type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript">
    $("document").ready(function(){
      var a=0;
      var b=0;
      $('.menubar').css({'transform':'translate(160px,30px)','transition' : 'all 0.4s ease-in-out'});
      $('.menubar').hide();

    	$('#menubutton').click(function(){
        b=0;
        if(a==0&&b==0){
          $('#menubutton').css({'transform': 'rotate(90deg)','transition' : 'all 0.4s ease-in-out'});
          $('.menubar').show(50);
          $('.menubar').css({'transform':'translate(0px,30px) scale(1,1)','transition' : 'all 0.4s ease-in-out'});


          a=1;b=1;
        }
        if(a==1&&b==0){
          $('#menubutton').css({'transform': 'rotate(0deg)','transition' : 'all 0.4s ease-in-out'});
          $('.menubar').css({'transform':'translate(160px,30px) scale(0.1,1)','transition' : 'all 0.4s ease-in-out'});
          $('.menubar').hide(400);
          a=0;b=1;
        }

      });

    });
    </script>
  </head>
  <body>
    <div class="menubar">
      <ul>
        <a style="text-decoration:none;color: #2D2D2D;" href="index.php"><li>Home</li></a>
        <a style="text-decoration:none;color: #2D2D2D;" href="edit.php"><li>Show Item</li></a>
        <a style="text-decoration:none;color: #2D2D2D;" href="edit.php"><li >Edit Items</li></a>
        <a style="text-decoration:none;color: #2D2D2D;" href="customers.php"><li>Customers</li></a>
        <li>Contact Us</li>
      </ul>
    </div>
    <div class="header">
      <div class="title">
        Smart Shop
      </div>
      <div class="menu">
        <img src="menu.png" id="menubutton" />
      </div>
    </div>
    <div class="bar1">
      <div class="headingleft">
        Search Customers
      </div>
      <div class="heading">
        <form method="post" action="customers.php" style="float:right;">
          <input type="submit" id="formupdate" name="clean" Value="Clean" />
          </form>
      </div>
    </div>
    <div class="body">
      <div class="filling">
        <div class="left" style="text-align:center;">

          <br>
          <form method="post" action="customers.php">
            <input type="text" autofocus id="formname" name="id" placeholder="Enter List Number" /><br>
            <input type="submit" id="formsubmit" name="show" placeholder="Search" />
          </form>

      </div>
      <div class="right">
        <?php
          if($result){
            echo '<h3><u> List No. '.$id.' </u><a style="color:grey;float:right;font-size:14px;">('.$time.')</a></h3><br>';
            echo '<h2>'.$cname.'   <a style="color:blue;float:right;font-size:25px;">Total : '.$total.'</a></h2>';
          }
         echo $result;?>

             </div>
      </div>
    </div>
  </body>
</HTML>
