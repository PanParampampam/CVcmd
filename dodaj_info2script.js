$(document).ready(function() {
	$('info').keypress(function(event) {
	  if (event.keyCode == 13) {
		event.preventDefault();
		 var content = $(this).val();
		  $(this).val(content + "\n");
	  }
	});
});