onload = function() {
	document.getElementById("Commands").focus();
	var input = $("#Commands"); 
	tmp = input.val(); input.focus().val("").blur().focus().val(tmp);
}

document.addEventListener("click", function() {
	document.getElementById("Commands").focus(); 
	var input = $("#Commands"); 
	tmp = input.val(); input.focus().val("").blur().focus().val(tmp);} ); //te dwie funkcje sprawiaja, ze kursos caly czas jest "skupiony" na oknie wpisywania