<?php
	
	require_once('../inclusions/configuration.php');
	require_once('../inclusions/auto_chargement_classes.php');
	require_once("../inclusions/fonctions.php");
	require_once("inclusions/fonctions.php");
	
	if($_GET['idbooster'] == 300){
		echo "<p style='color:red; font-weight:bold; font-size:20px; text-align:center; margin-top:80px;'>Personne ne peut éditer Dieu !</p>";
	}	else {
		printStudentProfileToEdit($_GET['idbooster']);
	}

?>