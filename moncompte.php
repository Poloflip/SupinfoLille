<?php

	require_once("inclusions/haut.php");
	
	$chgMdp = "wait";
		
	if(isset($_POST['idbooster']) && isset($_POST['ancien_mdp']) && isset($_POST['nouveau_mdp'])  && isset($_POST['confirmation_mdp'])){
	
		if(majPassword($_POST['idbooster'],$_POST['ancien_mdp'],$_POST['nouveau_mdp'],$_POST['confirmation_mdp'])){
			$chgMdp = "succeed";
		} else {
			$chgMdp = "fail";
		}
		
	}
				
	if(isset($_POST['idbooster']) && isset($_POST['facebook']) && isset($_POST['twitter']) 
		&& isset($_POST['portable']) && isset($_POST['skype']) && isset($_POST['msn'])){
		
		if($_SESSION['idbooster'] == $_COOKIE['idbooster']){
			majInformationsStudent($_POST['idbooster'], $_POST['facebook'], 
				$_POST['twitter'], $_POST['skype'], $_POST['msn'], $_POST['portable']);
		}
	
	}
	
	$student = new Student($_COOKIE['idbooster']);
	
?>
	
	<div id="moncompte">
		
		<h2>Mon Compte <?php echo $STUDENT_IDBOOSTER ?> <span id="changer_mdp">Mot de passe</span></h2>
		
			<?php
			
			if($chgMdp == "succeed"){
				echo "<p id='reussite_chgMdp'>Votre mot de passe a bien été mis à jour.</p>";
			} elseif($chgMdp == "fail"){
				echo "<p id='echec_chgMdp'>La mise à jour de votre mot de passe a échoué.</p>";
			}
			
			?>
				
			<div id="identite">
				<img src='http://www.campus-booster.net/actorpictures/<?php echo $student->getIdbooster(); ?>.jpg'
				title='<?php echo $student->getNom() . " " . $student->getPrenom(); ?>'/>
			</div>
			<div id="identite2"><br/>
				Nom : <span><?php echo $student->getNom() ?></span><br/><br/>
				Prénom : <span><?php echo $student->getPrenom() ?></span><br/><br/>
				ID Booster : <span><?php echo $student->getIdbooster() ?></span>
			</div>
			
			<div id="compte_infos">
				<br/>
				<img src="images/promo.png" title="Promotion"/> 
				<span>Promotion : <strong><?php echo $student->getPromo() ?></strong> </span>
				<br/>
				<img src="images/status.png" title="Status"/> 
				<span>Status : <strong><?php echo ($student->getAutorisation()==1) ? "Étudiant" : "Administrateur" ?></strong> </span>
				<br/>
				<img src="images/visites.png" title="Visites"/> 
				<span>Nombre de visites : <strong><?php echo $student->getVisites() ?></strong> </span>
				<br/>
				<img src="images/dernierevisite.png" title="Visites"/> 
				<span>Dernière visite : <strong><?php echo $student->getDerniere_visite() ?></strong></span>
			</div>
			
			<div id="mdp">
				<br/><br/>
				<form method="post" action="moncompte.php">
					<input type="hidden" name="idbooster" value="<?php echo $student->getIdbooster() ?>"/>
					<label>Mot de passe actuel :</label> <input type="password" name="ancien_mdp"/><br/><br/>
					<label>Nouveau mot de passe :</label> <input type="password" name="nouveau_mdp"/><br/><br/>
					<label>Confirmer le nouveau :</label> <input type="password" name="confirmation_mdp"/>
				</form>
			</div>
						
	</div>
	
	<div id="mesinformations">
	
		<form method="post" action="moncompte.php">
		
		<input type="hidden" name="idbooster" value="<?php echo $student->getIdbooster() ?>"/>
		
		<h2>Mes informations <span id="editer_informations">Éditer</span></h2>
		
			<img src="images/portable.png" title="Portable"/> 
			<span>Portable : <strong title="portable">0<?php echo $student->getPortable() ?></strong> </span>
			<br/><br/>
			<img src="images/facebook.png" title="Facebook"/> 
			<span>Facebook : <strong title="facebook"><?php echo $student->getFacebook() ?></strong></span>
			<br/><br/>
			<img src="images/twitter.png" title="Twitter"/> 
			<span>Twitter : <strong title="twitter"><?php echo $student->getTwitter() ?></strong></span>
			<br/><br/>
			<img src="images/skype.png" title="Skype"/> 
			<span>Skype : <strong title="skype"><?php echo $student->getSkype() ?></strong> </span>
			<br/><br/>
			<img src="images/live.png" title="MSN"/> 
			<span>MSN : <strong title="msn"><?php echo $student->getMsn() ?></strong> </span>
			
		</form>
					
	</div>
	
<?php

	require_once("inclusions/bas.php");

?>

