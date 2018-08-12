<?php
$con = mysqli_connect("localhost","root","","graph");

$gx = '';
$gy = '';
$gxarray = array();
$gyarray = array();

$g = mysqli_query($con,"select * from creategraph");
    while($rg = mysqli_fetch_array($g)){
      $tempx = "'".$rg['xindex']."'";
      array_push($gxarray,$tempx);
      array_push($gyarray,$rg['yindex']);
    }

    $gx = implode(',',$gxarray);
    $gy = implode(',',$gyarray);

 ?>
 <!DOCTYPE html>
 <head>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <script type="text/javascript" src="chart.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <style>

      .chart-container{
        width:400px;
        height:300px;
      }

   </style>
 </head>
 <body>
   <div class="chart-container">
     		<canvas id="line-chartcanvas2" ></canvas>
  </div>


 </body>
 <script>

  var ctx = $("#line-chartcanvas2");

        var data = {
          labels : [<?php echo $gx;?>,''],
          datasets : [
            {
              label : "Average Marks",
              data : [<?php echo $gy;?>,10],
              backgroundColor : "#17a589",
              borderColor : "#0e6655",
              fill : true,
              lineTension : 0.02,
              pointRadius : 5,
              pointBorderWidth: 3
            }
          ]
        };

        var options = {
          title : {
            display : false,
            position : "top",
            text : "Average Marks",
            fontSize : 14,
            fontColor : "#111"
          },
          legend : {
            display : true,
            position : "bottom"
          }
        };

        var chart = new Chart( ctx, {
          type : "line",
          data : data,
          width:600,
          height:150,
          options : {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true
                  }
              }]
          }
        }

        } );


</script>
 </html>
