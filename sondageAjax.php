<?php

	require_once('inclusions/configuration.php');
	require_once('inclusions/auto_chargement_classes.php');
	require_once("inclusions/fonctions.php");
		
	$lastsondage = $BDD->select(
		"*",
		"TB_SONDAGES",
		"ORDER BY sondage_id DESC"
	);
	
	
	$dfin = explode("-", $lastsondage[0]->sondage_date_fin);
	$datefin = mktime(0,0,0,$dfin[1],$dfin[2],$dfin[0]);
	
	if ($datefin >= time()) {
	
		$sondageopt = $BDD->select(
			"*",
			"TB_SONDAGES_CHOIX",
			"WHERE sondage_id = ?",
			array($lastsondage[0]->sondage_id)
		);
		
		$total = 0;
		for ($i=0; $i < count($sondageopt); $i++) {
			 $total = $total + $sondageopt[$i]->sondage_choix_votes;
       	}
       	  
	 }
	 
	$voteid = $BDD->select(
		"student_sondage_reponses",
		"TB_STUDENTS",
		"WHERE student_idbooster = ?",
		array($_COOKIE[idbooster])
	);
	
	
	
	
		$data = "[";

	if ($datefin >= time()) { 
		for ($i=0; $i < count($sondageopt); $i++) { 
			$result = round(($sondageopt[$i]->sondage_choix_votes / $total)*100);
			$data .= "['".$sondageopt[$i]->sondage_choix."',".$result."],";
	 	} 
	}
	
	$data .= "]"; 
		
?>