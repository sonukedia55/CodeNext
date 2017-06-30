<?php
	$con = mysqli_connect("localhost","root","","smartshop");
  if(isset($_POST['edit'])){
    $id=$_POST['id'];
    $name=$_POST['item'];
    $count=$_POST['number'];
    $pp=$_POST['price'];
    $query = mysqli_query($con,"UPDATE items set avaliable='$count',price='$pp',item='$name' WHERE id='$id'");

  }
  if(isset($_POST['add'])){
    $name=$_POST['item'];
    $count=$_POST['number'];
    $pp=$_POST['price'];
    $query = mysqli_query($con,"INSERT into items values('','$name','$count','$pp')");

  }
  if(isset($_POST['remove'])){

    $aid=$_POST['id'];
    $query = mysqli_query($con,"DELETE FROM items WHERE id='$aid'");
  }


$result='<form method="post" action="edit.php" style="float:left;"><textarea type="text" id="itemname" cols="20" rows="2" name="item" placeholder="Enter Name"></textarea> <textarea type="text"  cols="10" rows="2" id="itemname" placeholder="price" name="price"></textarea><textarea type="text" id="itemname" cols="10" rows="2" placeholder="Available" name="number"></textarea> <input type="submit" id="formupdate" name="add" Value="Add" /><br><hr></form><br><br>';

$result.='<form method="post" action="edit.php" style="float:left;"><br><br><textarea type="text" id="itemhead" cols="20" rows="2" disabled>Item Name</textarea> <textarea name="piece" type="text"  cols="10" rows="2" id="itemhead" disabled>Price</textarea><textarea type="text" id="itemhead" cols="10" rows="2" disabled> Available</textarea><br><hr><br></form><br><br>';



    $ddf = mysqli_query($con, "SELECT  id,item,price,avaliable FROM items ORDER BY item ASC");
  		{
      while($r = mysqli_fetch_array($ddf)){
        $id = $r['id'];
  			$item=$r['item'];
        $price=$r['price'];
        $ava = $r['avaliable'];
        $result.='<form method="post" action="edit.php" style="float:left;"><textarea type="text" id="itemname" cols="20" rows="2" name="item" >'.$item.'</textarea> <textarea type="text"  cols="10" rows="2" id="itemname"  name="price">'.$price.'</textarea><textarea type="text" id="itemname" cols="10" rows="2" name="number"> '.$ava.'</textarea>
        <input type="hidden" value="'.$id.'" name="id"/> <input type="submit" id="formupdate" name="edit" Value="Update" /> <input type="submit" id="formremove" name="remove" Value="Remove" /></form><br>';

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
        Edit Items
      </div>
      <div class="heading">
        .
      </div>
    </div>
    <div class="body">
      <div class="filling">
        <div class="left">

        <?php echo $result;?>
      </div>
      <div class="right">
        .
             </div>
      </div>
    </div>
  </body>
</HTML>
