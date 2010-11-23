<?php
	
	require_once('../inclusions/configuration.php');
	require_once('../inclusions/auto_chargement_classes.php');
	require_once("../inclusions/fonctions.php");
	require_once("inclusions/fonctions.php");
	
	modifierStudentInfos($_GET['idbooster'], $_GET['what'], $_GET['new']);
	
?>