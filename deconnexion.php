<?php

	session_start();
	setcookie('idbooster', '', 0);
	setcookie('pass', '', 0);
	setcookie('nom', '', 0);
	setcookie('prenom', '', 0);
	setcookie('status', '', 0);
	session_destroy();
	header('location: connexion.php');

?>