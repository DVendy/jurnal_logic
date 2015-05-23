$(document).ready(function(){
	$("#download_submit").click(function(){
		console.log("LOL");
		$("#form_download").submit();
	});

	$( "#datepicker" ).datepicker({
		dateFormat: "yy/mm/dd",
		changeMonth: true,
		changeYear: true
	});

	var i=1;
	$("#add_row").click(function(){		
		$('#addr'+i).html("<td>" + (i+1) +"</td><td><input type='text' placeholder='Name' class='form-control' name='author[]'></input></td><td><input type='text' placeholder='Email' class='form-control' name='email[]'></input></td>");
		$('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
		i++; 
	});
	$("#delete_row").click(function(){
		if(i>1){
			$("#addr"+(i-1)).html('');
			i--;
		}
	});

});