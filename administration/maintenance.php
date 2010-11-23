<?php

	require_once('../inclusions/configuration.php');
	require_once('../inclusions/auto_chargement_classes.php');
	require_once("../inclusions/fonctions.php");
	require_once("inclusions/fonctions.php");

	$BDD = new BDD();
	
	$idboosters = $BDD->select(
		"student_idbooster, student_nom, student_prenom",
		"TB_STUDENTS",
		"WHERE student_promo = 'M1'"
	);
	
	// ************************************ maj des Accents ************************************
	
/*
	foreach($idboosters as $idbooster){
		$BDD->update(
			"TB_STUDENTS",
			array("student_nom = ?", "student_prenom = ?"),
			"student_idbooster = ?",
			array(htmlentities($idbooster->student_nom), htmlentities($idbooster->student_prenom), $idbooster->student_idbooster)
		);
	}
*/

	
	// ************************************ liste pour les mails ************************************
	
/*
	foreach($idboosters as $idbooster){
		echo $idbooster->student_idbooster . "@supinfo.com, ";
	}
*/
	
	// ************************************ Envoi des mails pour les logins	************************************
		
/*
	foreach($idboosters as $idbooster){
		echo $idbooster->student_nom . " " . $idbooster->student_prenom . " (" .$idbooster->student_idbooster . ") : " . "<br/>";

$message = 
"SupinfoLille2013.fr - Vos nouveaux identifiants de connexion
		
ID Booster : " . $idbooster->student_idbooster . 
"
Mot de Passe : " . initStudentPass($idbooster->student_idbooster) . 
"

Rendez vous sur www.supinfolille2013.fr pour vous connecter !";

		mail("".$idbooster->student_idbooster."@supinfo.com", "SupinfoLille2013.fr : Identifiants", $message, 'From: SupinfoLille2013.fr');
	}
*/

?>