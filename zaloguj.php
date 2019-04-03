<?php
	session_start();
	//funkcja pozwalająca kożystać dokumentowi z sesji
	
	if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
	{
		header('Location: index.php');	
		exit();
	}
	//jeżeli nie jest ustawiona zmienna w globalnej tablicy 'Post' o nazwie 'login' lub nie jest ustawiona zmienna w globalnej tablicy 'Post' o nazwie hasło 
	//to wówczas przekieruj przeglądarkę do pliku index.php

	require_once "connect.php";
	//przekieruje nas do bazy danych connect.php
	//w tej bazie mamy wszystich użytkowników (ich dane: nazwa uzytkownika, hasło, email itd),którzy mogą się już zalogować
	// jeśli użytkownik jeszcze nie może się zalogować, to z powrotem przekieruje go do index.php 

	$polaczenie=@new mysqli($host,$db_user,$db_password,$db_name);
	//połączenie z bazą, przy  pomocy obiektu klasy MySQLi
	//@- operator kontroli błędów, którym wyciszam wyświetlanie się ostrzeżeń ze strony Php o błedach

	if($polaczenie->connect_errno!=0)
	{
	echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
		$login = $_POST['login'];
		$haslo = $_POST['haslo'];
		//moja własna kontrola błędu połączenia
		//jeśli będzie 0 - to nie uda się połączyć, a jesli będzie liczba>0 to wypisze login i hasło
	
		$login = htmlentities($login,ENT_QUOTES, "UTF-8");
		$haslo = htmlentities($haslo,ENT_QUOTES, "UTF-8");
	
		if ($rezultat=@$polaczenie->query(
		sprintf("SELECT * FROM uzytkownicy WHERE user='%s' AND pass='%s'",
		mysqli_real_escape_string($polaczenie,$login),
		mysqli_real_escape_string($polaczenie,$haslo))))
		//zabezpieczenie loginu i hasła przed wstrzyknięciem SQL
		{
			$ilu_userow=$rezultat->num_rows;
			//num_rows- liczba zwróconych wierszy	
			if($ilu_userow>0)
			{
		
				$_SESSION['zalogowany']=true;
				//zmienna odpowiadająca true, jesli ktoś jest zalogowany mająca związek funkcją z index.php
				$wiersz=$rezultat->fetch_assoc();
				//etch_assoc - tablica asocjacyjna, w której są zmienne o takiej samej nazwie, jak kolumny w bazie danych
				$_SESSION['id']=$wiersz['id'];
				$_SESSION['user']=$wiersz['user'];
				//$wiersz - nazwa tablicy asocjacyjnej; ['user']- nazwa kolumny w bazie i zarazem indeks w tablicy
				$_SESSION['drewno']=$wiersz['drewno'];
				$_SESSION['kamien']=$wiersz['kamien'];
				$_SESSION['zelazo']=$wiersz['zelazo'];
				$_SESSION['zloto']=$wiersz['zloto'];
				$_SESSION['glina']=$wiersz['glina'];
				
				$_SESSION['email']=$wiersz['email'];
				$_SESSION['dnipremium']=$wiersz['dnipremium'];
	
				unset($_SESSION['blad']);
				//funkcja unset-> jesli uda się zalogować - usuń z sesji zmienną 'błąd'
				$rezultat->free_result();
				//metoda, którą pozbywam się z pamięci nie potrzebne rezultaty zapytania
				header('Location: gra.php');
				//przekierowanie do pliku gra.php
	
			} else {
				$_SESSION['blad']='<span style="color:red">Nieprawidłowy login lub hasło!</span>';	
				//sprawdzanie zgodności danych użytkowników podczas łączenia z bazą danych
				header('Location: index.php');
				//w przypadku błędu logowania wracamy do index.php
			}
			
		}
		
		$polaczenie->close();
		//close - zamknie połączenie, jeśli połaczenie zostało otwarte bez błędu
	}
?>