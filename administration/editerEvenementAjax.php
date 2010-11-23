<?php

	require_once('../inclusions/configuration.php');
	require_once('../inclusions/auto_chargement_classes.php');
	require_once("inclusions/fonctions.php");

	if(isset($_GET['creation'])){
		printCreationEvenement();
	} else {
		printEditionEvenement($_GET['id']);
	}

?>