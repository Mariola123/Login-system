<?php
	session_start();
	session_unset();
	header('Location:index.php');
	
	//niszczę całą sesję podczas wylogowania i przekierowuję na index.php w celu ponownego zalogowania
?>
