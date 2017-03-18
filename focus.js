onload = function() {
	document.getElementById("Commands").focus();
	var input = $("#Commands"); 
	tmp = input.val(); input.focus().val("").blur().focus().val(tmp);
}

document.addEventListener("click", function() {
	document.getElementById("Commands").focus(); 
	var input = $("#Commands"); 
	tmp = input.val(); input.focus().val("").blur().focus().val(tmp);} ); //te dwie funkcje sprawiaja, ze kursos caly czas jest "skupiony" na oknie wpisywania
	
Mousetrap.bind ('up', function (Commands){
			Commands.preventDefault();
			window.scrollBy(0, -100);
			});
			
Mousetrap.bind ('down', function (Commands){
			Commands.preventDefault();
			window.scrollBy(0, 100);
			});  //te dwie sprawiaja, ze dzieki strzalkom gora/dol okno jest scrollowane