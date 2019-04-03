<?php
	session_start();
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: gra.php');
		exit();
	}
	//jeśli zajdą jednocześnie oba warunki przekieruj do pliku gra.php z użyciem instrukcji header 'Location'
	//exit- instrukcja dzięki której tu kończy się przetwarzanie indeksu
?>
	
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<title>Plemiona - gra przeglądarkowa</title>
	</head>
	
	<body>
	Odwaga jest to wiedza o tym, czego się bać, a czego nie. Platon<br/><br/>
	
	<form action="zaloguj.php" method="post">
		<!-- podczas logowania połączy się z plikiem zaloguj.php
		post jest metodą, która służy do obsługi formularzy HTML-->
		Login:<br/><input type="text" name="login"/><br/>
		Hasło:<br/><input type="passwort" name="haslo"/><br/>
		<input type="submit" value="Zaloguj się"/>
	</form>
<?php
	If(isset($_SESSION['blad']))  echo$_SESSION['blad'];
	//funkcja, dzięki której wyświetli się błąd logowania jesli dany użykownik istnieje w bazie danych
	//nie wyświetli błedu, jeśli ktoś pierwszy raz pojawił się na stronie/ nie jest jej zarejestrowanym użytkownikiem
?>
	</body>
	</html>