var Result, GetCommand, AllCommands = [], Counter = 0;
function SwitchCommands (){
	var OldDiv = null;
	var NewDiv = null;
	var NewResult = null;
	NewDiv = document.createElement("div");
	NewDiv.innerHTML = 'CVcmd:\\' +  document.getElementById("User").value + '&gt;' + document.getElementById("Commands").value + "<br/>";
	NewResult = document.createElement("div");
	NewResult.innerHTML = Result + "<br/><br/>";
	OldDiv = document.getElementById("PastCommands");
	document.body.insertBefore(NewDiv, OldDiv);
	document.body.insertBefore(NewResult, OldDiv);
	document.getElementById("Commands").value = null;
}

function Help () {
	Result = "<table style='width:100%, text-align:left'>" +
			"<tr><td>+DANE<td><td>Dodaj lub edytuj dane osobowe w Twoim CV</td></tr>"  +
			"<tr><td>+INFO<td><td>Dodaj sekcje do Twojego CV</td></tr>"  +
			"<tr><td>eINFO<td><td>Edytuj sekcje</td></tr>"  +
			"<tr><td>zINFO<td><td>Zamień dwie sekcje miejscami</td></tr>"  +
			"<tr><td>-INFO<td><td>Usuń sekcje</td></tr>"  +
			"<tr><td>CV<td><td>Wyświetla i pozwala edytować wprowadzone dane oraz informacje, a także wygenerować z nich gotowe CV</td></tr>" +
			"<tr><td>EXAMPLE<td><td>Przykładowe CV</td></tr>" +
			"<tr><td>HELP<td><td>Wyświetla listę komend</td></tr>" +
			"<tr><td>HOW<td><td>Poradnik jak zacząć</td></tr>" +
			"<tr><td>LOGIN<td><td>Przejście do strony logowania</td></tr>" +
			"<tr><td>LOGOUT<td><td>Wylogowanie</td></tr>" +
			"<tr><td>SIGNIN<td><td>Założenie nowego konta użytkownika</td></tr>" +
			"<tr><td>SIGNOUT<td><td>Usunięcie konta użytkownika</td></tr></table>";
}

function How () {
	Result = "Zacznij od dodania swoich danych osobowych poleceniem +DANE. Następnie możesz zająć się tworzeniem sekcji swojego CV. " +
				"Na każdą sekcje składa się nagłówek, oraz informacje, na przykładzie:</br></br>" +
				"<strong>Umiejętności</strong></br>" +
				"&bull; Regeneracja do 12 razy włącznie</br>&bull; Zdolności telepatyczne</br>&bull; Wykrywanie dotykiem obecności jonów i sprawdzanie rodzaju substancji za pomocą języka</br></br>" +
				"Możesz dodać dowolną liczbę sekcji, a następnie je edytować, zamieniać miejscami lub usuwać. </br>" +
				"W każdej chwili możesz zobaczyć wszystkie dodane przez Ciebie informacje (dane osobiste i sekcje) za pomocą komendy CV.</br>" +
				"Stamtąd możesz przejść do ostatniego kroku, gdzie będziez mógł dodać swoje zdjęcie (będzie ono usuwane z naszej bazy po wylogowaniu lub po upływie 12 godzin),</br>" +
				"A następnie wydrukować, przekopiować (np do pliku DOC lub ODT) lub zapisać swoje CV (jako plik PDF).</br>" +
				"Kiedy uznasz swoje CV za skończone możesz usunąć swoje konto poleceniem SIGNOUT. Usunięte zostaną przy tym wszystkie informacje z nim związane (dane osobowe, sekcje, zdjęcie).";
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
			case "+dane":
				window.location.href = "dodaj_dane1godnosc.php";
				return;
			case "+info":
				window.location.href = "+info1naglowek.php";
				return;
			case "einfo":
				window.location.href = "einfo1wybierz.php";
				return;
			case "zinfo":
				window.location.href = "zinfo1wybierz.php";
				return;
			case "-info":
				window.location.href = "-info1wybierz.php";
				return;
			case "example":
				window.location.href = "example.php";
				return;
			case "help":
				Help();
				break;
			case "how":
				How();
				break;
			case "login":
				window.location.href = "login.php";
				return;
			case "logout":
				window.location.href = "logout.php";
				return;
			case "signin":
				window.location.href = "signin1user.php";
				return;
			case "signout":
				window.location.href = "signout1password.php";
				return;
			case "cv":
				window.location.href = "cv.php";
				return;
			default:
				Result = "<span style='color:red'>Polecenie '" + GetCommand + "' nie jest rozpoznawalne.</span>";
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