<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}	
	//zamykanie sesji, kiedy nie jesteśmy zalogowani i zatrzymanie sesji dla zalogowanych użytkowników
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>

	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Plemiona - gra przeglądarkowa</title>
</head>
	
<body>

<?php

	echo "<p>Witaj ".$_SESSION['user'].'! [ <a href="logout.php">Wyloguj się!</a> ]</p>';
	echo "<p><b>Drewno</b>: ".$_SESSION['drewno'];
	echo " | <b>Kamień</b>: ".$_SESSION['kamien'];
	echo " | <b>Żelazo</b>: ".$_SESSION['zelazo'];
	echo " | <b>Złoto</b>: ".$_SESSION['zloto'];
	echo " | <b>Glina</b>: ".$_SESSION['glina']."</p>";

	echo "<p><b>E-mail</b>: ".$_SESSION['email'];
	echo "<br /><b>Dni premium</b>: ".$_SESSION['dnipremium']."</p>";
	//przywitanie dla każdego zalogowanego użytkownika - wyświetla jego login oraz link "Wyloguj się"
	//separator pomiędzy danymi w jednym paragrafie
?>

</body>
</html>