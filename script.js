var Result, GetCommand, AllCommands = [], Counter = 0;
function SwitchCommands (){
	var OldDiv = null;
	var NewDiv = null;
	var NewResult = null;
	NewDiv = document.createElement("div");
	NewDiv.innerHTML = 'C:\\&gt;' + document.getElementById("Commands").value + "<br/>";
	NewResult = document.createElement("div");
	NewResult.innerHTML = Result + "<br/><br/>";
	OldDiv = document.getElementById("PastCommands");
	document.body.insertBefore(NewDiv, OldDiv);
	document.body.insertBefore(NewResult, OldDiv);
	document.getElementById("Commands").value = null;
	// ta funkcja sprawia, ze "nowy" tekst bedzie sie wyswietlal pod "starym",
	// razem z tym co bedzie w Result, ktore jest zalezne od tego jaka komende wpisze uzytkownik
	// na koncu funkcja czysci pole okna do wpisywania.
	// Na razie bardzo prymitywnie, ale dalej Result mozemy zrobic np jako obiekt
	// i wtedy zaleznie od tego co wpisze uzytkownik wywolamy inna funkcje
}

function Help () {
	Result = "<table style='width:100%, text-align:left'>" +
			"<tr><td>HELP<td><td>Wyświetla listę komend</td></tr>" +
			"<tr><td>LOGIN<td><td>Przejście do strony logowania</td></tr>" +
			"<tr><td>LOGOUT<td><td>Wylogowanie</td></tr>" +
			"<tr><td>SIGNIN<td><td>Założenie nowego konta użytkownika</td></tr>" +
			"<tr><td>TEST<td><td>testowanie ajaxa i php</td></tr>" +
			"<tr><td>HTS<td><td>Poradnik jak zacząć</td></tr></table>";
}

function Submit(key) { 
	if (key.keyCode === 13) { // jesli zostal wcisniety ENTER, to:
		GetCommand = document.getElementById("Commands").value.toLowerCase();
		AllCommands.push(GetCommand);
		switch (GetCommand) {
			case "":
				Result = '';
				AllCommands.pop();
				break;
			case "help":
				Help();
				break;
			case "login":
				window.location.href = "login.php";
				return;
			case "logout":
				window.location.href = "logout.php";
				return;
			case "signin":
				window.location.href = "signin1user.php";
			case "hts": //póki co sprawdzam tym poprawne działanie tablicy
				Result = AllCommands + Counter;
				break;
			case "test": //niepotrzebne
			function Test() {
			  var xhttp = new XMLHttpRequest();
			  xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
				 document.getElementById("Result").innerHTML = this.responseText;
				}
			  };
			  xhttp.open("GET", "Test.php?q=", true);
			  xhttp.send();
			}
				break;
			default:
				Result = "Polecenie '" + GetCommand + "' nie jest rozpoznawalne.";
		}
		Counter = AllCommands.length;
		SwitchCommands(); // i w tym momencie wywolujemy funkcje, ktore to wszystko odpowiednio wyswietla na ekranie
		window.scrollTo(0,document.body.scrollHeight); // automatyczne scrollowanie okna
	}
	if (key.keyCode === 38){ //arrowup
		if (Counter > 0) {
			Counter --;
			document.getElementById("Commands").value = AllCommands[Counter];
		}

	}
	if (key.keyCode === 40) { //arrowdown
		if (Counter < (AllCommands.length-1)) {
			Counter ++;
			document.getElementById("Commands").value = AllCommands[Counter];
		}

	}
}