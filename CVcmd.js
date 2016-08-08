﻿onload = function() {
	document.getElementById("Commands").focus();
}

document.addEventListener("click", function() {
	document.getElementById("Commands").focus(); } ); //te dwie funkcje sprawiaja, ze kursos caly czas jest "skupiony" na oknie wpisywania		
	
var Result;
function SwitchCommands (){
	var OldDiv = null;
	var NewDiv = null;
	NewDiv = document.createElement("div");
	NewDiv.innerHTML = 'C:\\&gt;' + document.getElementById("Commands").value + "<br/>" + Result + "<br/><br/>";
	OldDiv = document.getElementById("PastCommands");
	document.body.insertBefore(NewDiv, OldDiv);
	document.getElementById("Commands").value = null;
	// ta funkcja sprawia, ze "nowy" tekst bedzie sie wyswietlal pod "starym",
	// razem z tym co bedzie w Result, ktore jest zalezne od tego jaka komende wpisze uzytkownik
	// na koncu funkcja czysci pole okna do wpisywania.
	// Na razie bardzo prymitywnie, ale dalej Result mozemy zrobic np jako obiekt
	// i wtedy zaleznie od tego co wpisze uzytkownik wywolamy inna funkcje
}

function Help () {
	Result = "<table style='width:100%, text-align:left'>" +
			"<tr><td>CLS<td><td>Czyści ekran</td></tr>" + 
			"<tr><td>HELP<td><td>Wyświetla listę komend</td></tr>" +
			"<tr><td>NEW<td><td>Stworzenie nowego CV</td></tr>" +
			"<tr><td>EDIT<td><td>Edycja zapisanego CV</td></tr>" +
			"<tr><td>DELETE<td><td>Usunięcie zapisanego CV</td></tr>" +
			"<tr><td>SAVE<td><td>Zapisanie roboczego CV</td></tr>" +
			"<tr><td>START<td><td>Rozpoczęcie procesu wypełniania CV od zera</td></tr>" +
			"<tr><td>END<td><td>Zakończenie pracy</td></tr>" +
			"<tr><td>EXIT<td><td>Wyjście z edycji roboczego CV</td></tr>" +
			"<tr><td>HTS<td><td>Poradnik jak zacząć</td></tr></table>";
}

function Submit(key) { 
	if (key.keyCode === 13) { // jesli zostal wcisniety ENTER, to:
		var GetCommand = document.getElementById("Commands").value.toLowerCase();
		switch (GetCommand) {
			case "":
				Result = '';
				break;
			case "help":
				Help();
				break;
			case "cls": //clr dziala jako odswiezanie strony, na razie nic lepszego nie wymyslilem
				location.reload();
				Result = '';
			default:
				Result = "Polecenie '" + GetCommand + "' nie jest rozpoznawalne.";
				
		}
		SwitchCommands(); // i w tym momencie wywolujemy funkcje, ktore to wszystko odpowiednio wyswietla na ekranie
		window.scrollTo(0,document.body.scrollHeight); // automatyczne scrollowanie okna
	}
}