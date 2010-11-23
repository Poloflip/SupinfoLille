<?php

	require_once('../inclusions/configuration.php');
	require_once('../inclusions/auto_chargement_classes.php');
	require_once("../inclusions/fonctions.php");
	require_once("inclusions/fonctions.php");
		
	if($_GET['initial'] == "true"){
	
		searchAndPrintStudents("", true);
	
	} else {
	
		searchAndPrintStudents(htmlentities($_GET['recherche'],ENT_NOQUOTES,'UTF-8'));
	
	}
		
?>