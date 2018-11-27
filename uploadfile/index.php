<!DOCTYPE html>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<style>
body{
  background-color: lightgrey;
  width: 100%;
  float: left;
}
#container{
  width: 30%;
  float: left;
  margin: 100px 30%;
  padding: 100px 30px;
  text-align: center;
  float: left;
  border-radius: 4px;
  background-color: white;
}
input,button{
  margin: 10px 0;
  width: 90%;
}

</style>
<script>

function uploadfile(){
  var filename = $('#filename').val();                    //To save file with this name
  var file_data = $('.fileToUpload').prop('files')[0];    //Fetch the file
  var form_data = new FormData();
  form_data.append("file",file_data);
  form_data.append("filename",filename);
  //Ajax to send file to upload
  $.ajax({
      url: "load.php",                      //Server api to receive the file
             type: "POST",
             dataType: 'script',
             cache: false,
             contentType: false,
             processData: false,
             data: form_data,

          success:function(dat2){
            if(dat2==1) alert("Successful");
            else alert("Unable to Upload");
          }
    });

}


</script>
<body>

  <div id="container">

    <input type="file" class="fileToUpload form-control" ></input><br>
    <input type="text" placeholder="File name" id="filename" class="form-control"/><br>
    <button class="btn btn-success" onclick="uploadfile()">Upload</button>

  </div>

</body>
</html>
