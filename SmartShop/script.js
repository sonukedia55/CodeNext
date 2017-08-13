function autocomplet(){

  var min = 0;
  var keyword = $('#formname').val();
  if(keyword.length> min){

    $.ajax({

        url: 'searching.php',
        type: 'POST',
        data: {keyword:keyword},
        success:function(data){
          $('#country_list').show();
          $('#country_list').html(data);
        }
      });
    }
    else{
      $('#country_list').hide();
    }
  }
