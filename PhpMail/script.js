function utocomplet() {
	var min_length = 0; // min caracters to display the autocomplete
	var keyword = $('#friend_list').val();
	if (keyword.length > min_length) {
		$.ajax({
			url: 'search.php',
			type: 'POST',
			data: {keyword:keyword},
			success:function(data){
				$('#friend_list_list').show();
				$('#friend_list_list').html(data);
			}
		});
	} else {
		$('#friend_list_list').hide();
	}
}

// set_item : this function will be executed when we select an item
function set_item(item,item2) {
	// change input value
	$('#friend_list').val(item);
	$('#get_list').val(item2);
	// hide proposition list
	$('#friend_list_list').hide();
}
function set_items(item,item2,item3) {
	if(item3==2){
	// change input value
	$('#friend_id').val(item);
	$('#get_id').val(item2);
	// hide proposition list
	$('#friend_list_id').hide();}
}
