<?php
$new=1;
$total=0;
$id=0;
	$con = mysqli_connect("localhost","root","","smartshop");
  if(isset($_POST['add'])){
    $new=0;
    $id=$_POST['id'];
    $name=$_POST['item'];
    $count=$_POST['number'];
    $ddf = mysqli_query($con, "SELECT  id,price,avaliable FROM items WHERE item='$name'");
  		{

  		while($r = mysqli_fetch_array($ddf)){
  			$price=$r['price'];
        $ava=$r['avaliable'];
        $pid= $r['id'];
        $ava=$ava-$count;
        $query = mysqli_query($con,"UPDATE items set avaliable='$ava' WHERE id='$pid'");
  		}
    }
    $cost = $price*$count;
    $query = mysqli_query($con,"INSERT into data values('','$id','$name','$count','$price','$cost')");

  }
	if(isset($_POST['save'])){
    $new=0;
    $cid=$_POST['id'];
    $total=$_POST['amount'];
    $name=$_POST['cname'];
		date_default_timezone_set('Asia/Kolkata');
		$time = date('Y-m-d H:i:s');
    $query = mysqli_query($con,"INSERT into user values('','$name','$cid','$total','$time')");
		$query = mysqli_query($con,"DELETE  FROM error WHERE uid='$cid'");
		$new=1;
		$total=0;

  }
  if(isset($_POST['remove'])){
    $new=0;
    $id=$_POST['id'];
    $id2=$_POST['id2'];

    $query = mysqli_query($con,"DELETE  FROM data WHERE uid='$id2'");

  }
  if(isset($_POST['update'])){
    $new=0;
    $id=$_POST['id'];
    $pp = $_POST['piece'];
    $id2=$_POST['id2'];
    $ddf = mysqli_query($con, "SELECT  price FROM data WHERE uid='$id2'");
  		{

  		while($r = mysqli_fetch_array($ddf)){
  			$pp2=$r['price'];
        $cst = $pp2*$pp;

        $query = mysqli_query($con,"UPDATE data set piece='$pp',cost='$cst' WHERE uid='$id2'");
  		}

  }
}
  if(isset($_POST['newlist'])){
    $new=0;

    $ddf = mysqli_query($con, "SELECT  id FROM count");
  		{

  		while($r = mysqli_fetch_array($ddf)){
  			$id=$r['id'];
        $idd=$id+1;
        $query = mysqli_query($con,"UPDATE count set id='$idd' WHERE id='$id'");

  		}}
			$query = mysqli_query($con,"INSERT into error values('','$id')");

		}
$result='';
  if($id!=0){

    $ddf = mysqli_query($con, "SELECT  uid,item,piece,cost,price FROM data WHERE id='$id'");
  		{
      while($r = mysqli_fetch_array($ddf)){
  			$item=$r['item'];
        $piece=$r['piece'];
        $cost=$r['cost'];
        $price=$r['price'];
        $id2 = $r['uid'];
        $total+=$cost;
        $result.='<form method="post" action="index.php" style="float:right;"><textarea type="text" id="itemname" cols="20" rows="2" disabled>'.$item.'</textarea> <textarea name="piece" type="text"  cols="3" rows="2" id="itemname" >'.$piece.'</textarea><textarea type="text" id="itemname" cols="5" rows="2" disabled>x '.$price.'</textarea><textarea type="text" id="itemname" cols="5" rows="2" disabled>'.$cost.'</textarea>
        <input type="hidden" value="'.$id2.'" name="id2"/><input type="hidden" value="'.$id.'" name="id"/> <input type="submit" id="formupdate" name="update" Value="Update" /> <input type="submit" id="formremove" name="remove" Value="Remove" /></form><br>';

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
<script type="text/javascript" src="script.js"></script>
<script type="text/javascript">
	$(function(){

				var pr=-1;
			 var cc = '';
				$('#country_idd').fadeOut();

			$('#formname').keyup(function(key) {

				switch(parseInt(key.which,10)) {

				case 38:
				{
					pr--;
					cc = $('#go'+pr).val();
					var pt = pr+1;
					$('#go'+pt).css({'color':'#ffffff'});
					 $('#go'+pr).css({'transform': 'rotate(90deg)','transition' : 'all 0.4s ease-in-out'});
					$('#country_idd').val(cc);

				}break;

				case 40:
				{
					pr++;
					var pt = pr-1;
					$('#go'+pt).css({'color':'#ffffff'});
					 $('#go'+pr).css({'transform': 'rotate(90deg)','transition' : 'all 0.4s ease-in-out'});
					cc = $('#go'+pr).val();
					$('#country_idd').val(cc);

				}break;

				case 13:
					{
						$('#formname').val(cc);
						$('#country_idd').val('');
						$('#country_list').fadeOut();
						$('#country_idd').fadeOut();

						cc='';
						pr=-1;


					}break;
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
        <?php if($new==1) echo '<form method="post" action="index.php"><input type="submit"  name="newlist" id="formremove" Value="Add List" /></form>';else echo  "List No.".$id;?>
      </div>
      <div class="heading">
        Total Amount : Rs <?php echo $total;?>
      </div>
    </div>
    <div class="body">
      <div class="filling">
        <div class="left">
          <h2>Enter Item : </h2>
          <br>
          <form method="post" action="index.php">
            <input type="hidden" value="<?php echo $id?>" name="id"/>
            <input type="text" autocomplete="off" autofocus id="formname" name="item" placeholder="Enter Name" onkeyup="autocomplet()"  />
						<input type="text" autocomplete="off" id="country_idd" disabled/>
      			<ul id="country_list"></ul>
            <input type="text" autocomplete="off" id = "formname" style="width:80px; margin-left:20px;" name="number" placeholder="Count" />
            <br><br>
            <input type="submit" id="formsubmit" name="add" placeholder="Add" />
          </form>
      </div>
      <div class="right">


        <?php
				if($result){
					echo
					'<form method="post" action="index.php" style="float:right;">
						<textarea type="text" id="itemname" cols="25" rows="2" name="cname" placeholder="Enter Customer name"></textarea>
						<input type="hidden" value="'.$id.'" name="id"/><input type="hidden" value="'.$total.'" name="amount"/><input type="submit" id="formupdate" name="save" Value="Payment" />
						</form><br>
						 <h3><u>Your List: </u></h3>
						 <br><br><br>';
				}
				echo $result;?>

	     </div>
      </div>
    </div>
  </body>
</HTML>
