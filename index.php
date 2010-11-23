<?php

	require_once("inclusions/haut.php");
		
	if(isset($_GET[pagenews])) {
		$pagenews = $_GET[pagenews]-1;	
	} else {
		$pagenews = 0;	
	}
	
	$news = getThisNew($pagenews);
	
	$maxnews = getNombreNews();
	
?>
 		
 	<div id="contenu">

 		<h1><?php echo $news->news_titre; ?></h1>
    
    	
    	<?php echo $news->news_contenu; ?>

		<p class="finnews">De : <strong><a href="etudiants.php?idbooster=<?php echo $news->news_auteur->getIdbooster() ?>"><?php echo $news->news_auteur->getPrenom() . " " . $news->news_auteur->getNom(); ?></a></strong> - Posté le : <strong><?php echo $news->news_date; ?></strong></p>
        <p><?php if(isset($_GET[pagenews]) && $_GET[pagenews] !=1) {  if ($_GET[pagenews] <= $maxnews) { ?>
        <a href="?pagenews=<?php echo $_GET[pagenews] + 1; ?>"> <img src="images/gauche.png" alt="précédent" style="float:left;margin-top:-15px;" /> News précédente</a> <?php } ?>
        <span style="float:right;"><a href="?pagenews=<?php echo $pagenews; ?>"><img src="images/droite.png" alt="suivant" style="float:right;margin-top:-15px;" /> News suivante </a></span> 
		<?php } else { ?>
        <a href="?pagenews=2"><img src="images/gauche.png" alt="précédent" style="float:left; margin-top:-15px;" /> News précédente</a><?php } ?>
        </p>
    
    </div>    
    
    <div class="encart" id="compte" onclick="location.href='moncompte.php'"><div class="encart" id="compte2"></div></div>
    <div class="encart" id="document" onclick="location.href='documents.php'">   <div class="encart" id="document2"></div></div>
    <div class="encart" id="etudiant" onclick="location.href='etudiants.php'"><div class="encart" id="etudiant2"></div></div>
    	<div style="clear:left"></div>
    <div class="encart" id="event" onclick="location.href='evenements.php'"><div class="encart" id="event2"></div></div>
    <div class="encart" id="sondage" onclick="location.href='sondages.php'"><div class="encart" id="sondage2"></div></div>
    <div class="encart" id="entraide" onclick="location.href='entraide.php'"><div class="encart" id="entraide2"></div></div>
    	<div style="clear:both"></div>
	
<?php

	require_once("inclusions/bas.php");

?>

