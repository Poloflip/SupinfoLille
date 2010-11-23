<?php

	require_once('inclusions/configuration.php');
	require_once('inclusions/auto_chargement_classes.php');
	require_once("inclusions/fonctions.php");
	
	if($_GET['action'] == "jeparticipe"){
		inscriptionEvenement($_COOKIE['idbooster'], $_GET['evenement']);
		echo getActionThisEvent($_COOKIE['idbooster'], $_GET['evenement']);
	} elseif($_GET['action'] == "jeneparticipeplus") {
		desinscriptionEvenement($_COOKIE['idbooster'], $_GET['evenement']);
		echo getActionThisEvent($_COOKIE['idbooster'], $_GET['evenement']);
	} elseif($_GET['action'] == "participants") {
		echo getNbParticipantsEvenement($_GET['evenement']) . " participants";
	} elseif($_GET['action'] == "printparticipants") {
		printParticipantsEvenement($_GET['evenement']);
	}
	
?>