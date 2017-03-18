var Result, GetCommand, AllCommands = [], Counter = 0;
function SwitchCommands (){
	var OldDiv = null;
	var NewDiv = null;
	var NewResult = null;
	NewDiv = document.createElement("div");
	NewDiv.innerHTML = 'CVcmd:\\&gt;' + document.getElementById("Commands").value + "<br/>";
	NewResult = document.createElement("div");
	NewResult.innerHTML = Result + "<br/><br/>";
	OldDiv = document.getElementById("PastCommands");
	document.body.insertBefore(NewDiv, OldDiv);
	document.body.insertBefore(NewResult, OldDiv);
	document.getElementById("Commands").value = null;
}

function Help () {
	Result = "<table style='width:100%, text-align:left'>" +
			"<tr><td>EXAMPLE<td><td>Przykładowe CV</td></tr>" +
			"<tr><td>HELP<td><td>Wyświetla listę komend</td></tr>" +
			"<tr><td>HOW<td><td>Poradnik jak zacząć</td></tr>" +
			"<tr><td>LOGIN<td><td>Przejście do strony logowania</td></tr>" +
			"<tr><td>SIGNIN<td><td>Założenie nowego konta użytkownika</td></tr></table>";	
}

function How () {
	Result = "Zacznij od stworzenia i zalogowania się na konto użytkownika. Po stworzeniu konta uzyskasz dostęp do wszystkich komend związanych z tworzeniem CV.</br>" +
				"Na podany przez Ciebie e-mail nigdy nie zostaną wysłane żadne niechciane informacje, ponadto konto możesz usunąć w każdej chwili, usuwając przy tym z naszej bazy danych wszystkie informacje z nim związane.";
}

function Submit(key) { 
	if (key.keyCode === 13) { // jesli zostal wcisniety ENTER, to:
		GetCommand = document.getElementById("Commands").value.toLowerCase();
		switch (GetCommand) {
			case "":
				Result = '';
				AllCommands.pop();
				break;
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
			case "signin":
				window.location.href = "signin1user.php";
				return;
			default:
				Result = "<span style='color:red'>Polecenie '" + GetCommand + "' nie jest rozpoznawalne.</span>";
		}
		SwitchCommands(); // i w tym momencie wywolujemy funkcje, ktore to wszystko odpowiednio wyswietla na ekranie
		window.scrollTo(0,document.body.scrollHeight); // automatyczne scrollowanie okna
	}
}