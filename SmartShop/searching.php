
<?php
  $con = mysqli_connect('localhost','root','','autocomplet');

  $keyword = $_POST['keyword'].'%';

  $sqli = "SELECT country_name FROM country WHERE country_name LIKE '$keyword' ORDER BY country_id";

$gh = '<ul>';
$in=0;

  $sql = mysqli_query($con,$sqli);{
    while($rp = mysqli_fetch_array($sql)){

        $gh.='<input type="hidden" value="'.$rp['country_name'].'" id="go'.$in.'" />';
        $gh.='<li >'.$rp['country_name'].'</li>';
        $in++;

    }
  }

  echo $gh;
  $gh='';

 ?>
