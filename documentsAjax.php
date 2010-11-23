<?php

	require_once('inclusions/configuration.php');
	require_once('inclusions/auto_chargement_classes.php');
	require_once("inclusions/fonctions.php");
	require_once('inclusions/librairies/pclzip.php');


if($_GET['section'] == "matieres")
{

	printListeMatieres($_GET['promo']);
	
} elseif($_GET['section'] == "documents")
{
	
	printListeDocuments($_GET['matiere']);
	
} elseif($_GET['section'] == "telechargements")
{		
	$documents = explode("a", $_GET['documents']);
	$documents = array_unique($documents);
		
	if($documents[0] != ""){
		echo getArchive($documents);
	}
 	
} elseif($_GET['section'] == "ddl")
{		
	$chemin = getSourcesDocuments($_GET['document']);
		
	echo $chemin[0];
}

?>