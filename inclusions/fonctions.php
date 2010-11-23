<?php

/* ************ printParticipantsEvenement() ************
 * 
 * Affiche les participants d'un evenement
 * 
 */

	function printParticipantsEvenement($p_event_id){
	
		$BDD = new BDD();
	
		$participants = $BDD->select(
			"student_idbooster",
			"TB_EVENEMENTS_PARTICIPATIONS",
			"WHERE evenement_id = ?",
			array($p_event_id)
		);
		
		if(count($participants)==0){
			echo "<em>Aucun participant pour le moment</em>";
		}
				
		foreach($participants as $participant){
			echo '<img src="http://www.campus-booster.net/actorpictures/' . $participant->student_idbooster . '.jpg"/>';
		}
	
	}
	
/* ************ getNbParticipantsEvenement() ************
 * 
 * Renvoit le nombre de participants
 * 
 * @return string nb participants
 *
 */

	function getNbParticipantsEvenement($p_event_id){
	
		$BDD = new BDD();
	
		$participants = $BDD->select(
			"*",
			"TB_EVENEMENTS_PARTICIPATIONS",
			"WHERE evenement_id = ?",
			array($p_event_id)
		);
				
		return count($participants);
		
	}

/* ************ desinscriptionEvenement() ************
 * 
 * Desinscrit un idbooster d'un evenement
 * 
 */

	function desinscriptionEvenement($p_idbooster, $p_event_id){
	
		$BDD = new BDD();
		
		$participation = $BDD->select(
			"*",
			"TB_EVENEMENTS_PARTICIPATIONS",
			"WHERE evenement_id = ? AND student_idbooster = ?",
			array($p_event_id, $p_idbooster)
		);
		
		if(count($participation)>0){
	
			$BDD->delete(
				"TB_EVENEMENTS_PARTICIPATIONS",
				"evenement_id = ? AND student_idbooster = ?",
				array($p_event_id, $p_idbooster)
			);
		
			$BDD->update(
				"TB_EVENEMENTS",
				array("evenement_participants = evenement_participants - 1"),
				"evenement_id = ?",
				array($p_event_id)
			);
		}
	
	}

/* ************ inscriptionEvenement() ************
 * 
 * Inscrit un idbooster a un evenement
 * 
 */

	function inscriptionEvenement($p_idbooster, $p_event_id){
	
		$BDD = new BDD();
		
		$participation = $BDD->select(
			"*",
			"TB_EVENEMENTS_PARTICIPATIONS",
			"WHERE evenement_id = ? AND student_idbooster = ?",
			array($p_event_id, $p_idbooster)
		);
		
		if(count($participation)==0){
			
			$BDD->insert(
				"TB_EVENEMENTS_PARTICIPATIONS",
				array("evenement_id","student_idbooster"),
				array("?","?"),
				array($p_event_id, $p_idbooster)
			);
		
			$BDD->update(
				"TB_EVENEMENTS",
				array("evenement_participants = evenement_participants + 1"),
				"evenement_id = ?",
				array($p_event_id)
			);
		
		}
	
	}

/* ************ getActionThisEvent() ************
 * 
 * Renvoit l'action adapate pour l'utilissateur et cet evenement
 * 
 * @return string action
 *
 */

	function getActionThisEvent($p_idbooster, $p_event_id){
	
		$BDD = new BDD();
	
		$actif = $BDD->select(
			"evenement_date",
			"TB_EVENEMENTS",
			"WHERE evenement_id = ? AND evenement_date >= CURDATE()",
			array($p_event_id)
		);
		
		if(count($actif)==0){
			return "<em>Événement passé</em>";
		}
	
		$participe = $BDD->select(
			"*",
			"TB_EVENEMENTS_PARTICIPATIONS",
			"WHERE evenement_id = ? AND student_idbooster = ?",
			array($p_event_id, $p_idbooster)
		);
				
		if(count($participe)==0){
			return "<span title='".$p_event_id."' class='jeparticipe'>Je participe</span>";
		} else {
			return "<span title='".$p_event_id."' class='jeneparticipeplus'>Je ne participe plus</span>";
		}
		
	}

/* ************ getInactifsEvenements() ************
 * 
 * Renvoit tous les evenements actifs
 *
 * @return array tous les evenements actifs
 *
 */

	function getInactifsEvenements(){
	
		$BDD = new BDD();
	
		$evenements = $BDD->select(
			"evenement_id, evenement_titre, evenement_ss_titre, evenement_description, evenement_participants, DATE_FORMAT(evenement_date, '%d/%b/%Y') as evenement_date",
			"TB_EVENEMENTS",
			"WHERE evenement_date < CURDATE() ORDER BY evenement_date DESC, evenement_id DESC"
		);
	
		return $evenements;
	
	}
	
/* ************ getActifsEvenements() ************
 * 
 * Renvoit tous les evenements actifs
 *
 * @return array tous les evenements actifs
 *
 */

	function getActifsEvenements(){
	
		$BDD = new BDD();
	
		$evenements = $BDD->select(
			"evenement_id, evenement_titre, evenement_ss_titre, evenement_description, evenement_participants, DATE_FORMAT(evenement_date, '%d/%b/%Y') as evenement_date",
			"TB_EVENEMENTS",
			"WHERE evenement_date >= CURDATE() ORDER BY evenement_date DESC, evenement_id DESC"
		);
	
		return $evenements;
	
	}

/* ************ getAllEvenements() ************
 * 
 * Renvoit tous les evenements
 *
 * @return array tous les evenements
 *
 */

	function getAllEvenements(){
	
		$BDD = new BDD();
	
		$evenements = $BDD->select(
			"evenement_id, evenement_titre, evenement_ss_titre, evenement_description, evenement_participants, DATE_FORMAT(evenement_date, '%d/%b/%Y') as evenement_date",
			"TB_EVENEMENTS",
			"ORDER BY evenement_date DESC, evenement_id DESC"
		);
	
		return $evenements;
	
	}

/* ************ stripAccents() ************
 * 
 * Supprime tous les accents de la chaine
 * 
 */

	function stripAccents($string){ 
		return str_replace(
			explode(' ', 'à á â ã ä ç è é ê ë ì í î ï ñ ò ó ô õ ö ù ú û ü ý ÿ À Á Â Ã Ä Ç È É Ê Ë Ì Í Î Ï Ñ Ò Ó Ô Õ Ö Ù Ú Û Ü Ý'), 
			explode(' ', 'a a a a a c e e e e i i i i n o o o o o u u u u y y A A A A A C E E E E I I I I N O O O O O U U U U Y'), 
			$string
		); 
	}

/* ************ getDerniersDocuments() ************
 * 
 * Renvoit les derniers documents
 * 
 * @return array tous les documents
 *
 */

	function getDerniersDocuments(){

		$BDD = new BDD();
	
		$documents = $BDD->select(
			"document_nom",
			"TB_DOCUMENTS",
			"ORDER BY document_id DESC LIMIT 0,10"
		);
		
		return $documents;
	}

/* ************ ajouterDocument() ************
 * 
 * Ajoute un document dans la BDD et envoie une notification
 * 
 */

	function ajouterDocument($p_nom, $p_chemin, $p_ext, $p_student_id, $p_matiere_id){
	
		$BDD = new BDD();
		
		if($p_nom == ""){
			$p_nom = $p_chemin;
		}
	
		$BDD->insert(
			"TB_DOCUMENTS",
			array("document_nom","document_chemin","document_extension","document_date","student_id","matiere_id"),
			array("?","?","?","CURDATE()","?","?"),
			array($p_nom, $p_chemin, $p_ext, $p_student_id, $p_matiere_id)
		);
		
		mail("postmaster@makemyweb.fr", "SupinfoLille2013.fr", "Notification : Nouveau Document");
	
		return $matieres;
	
	}


/* ************ getAllMatieres() ************
 * 
 * Renvoit toutes les matieres disponnibles
 * 
 * @return array toutes les matieres
 *
 */

	function getAllMatieres(){
	
		$BDD = new BDD();
	
		$matieres = $BDD->select(
			"*",
			"TB_MATIERES",
			"ORDER BY matiere_nom_complet"
		);
	
		return $matieres;
	
	}
	

/* ************ getMatieresDocuments() ************
 * 
 * Renvoit toutes les matieres des documents en parametres
 * 
 * @return array toutes les matieres
 *
 */

	function getMatieresDocuments($p_in){
	
		$BDD = new BDD();
	
		$matieres = $BDD->select(
			"m.matiere_nom",
			"TB_MATIERES m JOIN TB_DOCUMENTS d ON d.matiere_id = m.matiere_id",
			"WHERE d.document_id IN(".$p_in.")"
		);
	
		return $matieres;
	
	}


/* ************ majNombreTelechargements() ************
 * 
 * Met à jour le compteur de telechargement des documents
 * 
 */

	function majNombreTelechargements($p_in){
	
		$BDD = new BDD();
		
		$BDD->update(
			"TB_DOCUMENTS",
			array("document_telechargements = document_telechargements + 1"),
			"document_id IN (".$p_in.")"
		);
	
	}
	
/* ************ getArchive() ************
 * 
 * Cree l'archive avec tous les documents et renvoit son chemin
 * 
 * @return string chemin de l'archive
 */

	function getArchive($p_documents){
	
		$in = "";
	
		foreach($p_documents as $document){
			$in .= $document . ",";
		}
		
		$in = substr($in, 0, strlen($in)-1);
	
		$sources = getSourcesDocuments($in);
		
		$date = date("YmdHis");
	
		$nom = 'telechargements/' . $_COOKIE['idbooster'] . ' - ' . $date . '.zip';
	
 		$archive = new PclZip($nom);
 	
 		$matieres = getMatieresDocuments($in);
 		$i = 0;
 		 		
 		foreach($sources as $source){
 			$archive->add($source, PCLZIP_OPT_REMOVE_ALL_PATH, PCLZIP_OPT_ADD_PATH, $_COOKIE['idbooster']."/".$matieres[$i]->matiere_nom);
 			$i++;
 		}
 		
 		majNombreTelechargements($in);
 		
 		return $nom;
	
	}

/* ************ getSourcesDocuments() ************
 * 
 * Retourne les chemins sources de tous les documents passes en paramètres
 * 
 * @return array tableau avec les chemins de tous les documents
 */

	function getSourcesDocuments($p_in){
		
		$BDD = new BDD();
	
		$sources = $BDD->select(
			"d.document_chemin, d.matiere_id, m.matiere_cursus",
			"TB_DOCUMENTS d JOIN TB_MATIERES m ON (d.matiere_id = m.matiere_id)",
			"WHERE d.document_id IN (".$p_in.")"
		);
		
		$chemins = array();
				
		foreach($sources as $source){
			array_push($chemins,"documents/".$source->matiere_cursus."/".$source->matiere_id."/".$source->document_chemin);
		}
		
		return $chemins;
	}

/* ************ printListeDocuments() ************
 * 
 * Affiche la liste des documents pour la matiere
 * 
 */

	function printListeDocuments($p_matiere){
	
		$BDD = new BDD();
	
		$documents = $BDD->select(
			"*",
			"TB_DOCUMENTS",
			"WHERE matiere_id = ? AND document_status != 0",
			array($p_matiere)
		);
		
		if(count($documents)==0){
		
			echo "<p id='recherche_vide'>Aucun document pour cette catégorie actuellement.</p>";
		
		} else {
		
			echo "<ul>";

			foreach($documents as $document){
				echo "<div class='document' title='" . $document->document_id . "'>" . 
					"<img src='images/" . $document->document_extension . ".png' title='" . $document->document_nom . "'/>" .
					"<br/>" . $document->document_nom . "</div>";
			}
		
			echo "</ul>";
		
		}
	
	}


/* ************ printListeMatieres() ************
 * 
 * Affiche la liste des matieres dispos pour la promo
 * 
 */

	function printListeMatieres($p_promo){
	
		$BDD = new BDD();
	
		$matieres = $BDD->select(
			"*",
			"TB_MATIERES",
			"WHERE matiere_cursus = ? ORDER BY matiere_nom",
			array($p_promo)
		);
	
		echo "<h3>" . $p_promo . "</h3>";
		
		echo "<ul>";
	
		foreach($matieres as $matiere){
			echo "<li class='matiere' title='" . $matiere->matiere_id . "'>" . $matiere->matiere_nom . "</li>";
		}
		
		echo "</ul>";
	
	}

/* ************ printStudentProfile() ************
 * 
 * Affiche le profile du student correspondant au booster
 * 
 */

	function printStudentProfile($p_idbooster){
	
	$student = new Student($p_idbooster);
	
	if($p_idbooster == 300){
		$student->setPromo("R2D2");
		$student->setPrenom("Alick");
		$student->setNom("Mouriesse"); 
		$student->setPortable("666666666"); 
		$student->setMsn("dieu@hotmail.com");
		$student->setSkype("DieuEstAussiSurSkype");
		$student->setTwitter("TwitDivin");
		$student->setFacebook("AlickBook"); 
		$student->setAutorisation(5);
		$student->setVisites("-1"); 
	} 
	
	if($student->getAutorisation()==1){
		$student->setAutorisation("Étudiant");
	}  elseif($student->getAutorisation()==0){
		$student->setAutorisation("Bloqué");
	} elseif($student->getAutorisation()==5){
		$student->setAutorisation("Dieu");
	} else {
		$student->setAutorisation("Admin");
	}
	
	if($student->getFacebook()==""){
		$student->setFacebook("Aucun Facebook renseigné.");
	} else {
		$student->setFacebook("<a href='http://www.facebook.com/".$student->getFacebook()."'>".$student->getFacebook()."</a>");
	}
	if($student->getTwitter()==""){
		$student->setTwitter("Aucun Twitter renseigné.");
	} else {
		$student->setTwitter("<a href='http://twitter.com/".$student->getTwitter()."'>".$student->getTwitter()."</a>");
	}
	if($student->getSkype()==""){
		$student->setSkype("Aucun Skype renseigné.");
	}
	if($student->getPortable()==""){
		$student->setPortable("Aucun Portable renseigné.");
	} else {
		$student->setPortable("0".$student->getPortable());
	}
	if($student->getMsn()==""){
		$student->setMsn("Aucun MSN renseigné.");
	}
	
	echo "<h2>". $student->getPrenom() . " " . $student->getNom() ." <div>" . $student->getIdbooster() . "</div></h2>";
	
	echo '<div id="identite">
		<img src="http://www.campus-booster.net/actorpictures/' . $student->getIdbooster() . '.jpg"/>
	</div>';
				
	echo "<div id='identite2'><br/>
		<img src='images/promo.png' title='Promotion'/> 
		<span>Promotion : <strong>" . $student->getPromo() . "</strong> </span>
			<br/>
		<img src='images/status.png' title='Status'/>
		<span>Status : <strong>" . $student->getAutorisation() . "</strong> </span>
			<br/>
		<img src='images/visites.png' title='Visites'/> 
		<span>Nombre de visites : <strong>" . $student->getVisites() . "</strong> </span>
	</div>";
					
	echo '<div id="compte_infos"><br/>
	 	<p>Cliquez sur les icônes pour afficher les informations</p>
		<img src="images/facebook.png" title="Facebook"/>
		<img src="images/twitter.png" title="Twitter"/> 
		<img src="images/portable.png" title="Portable"/> 
		<img src="images/skype.png" title="Skype"/>
		<img src="images/live.png" title="MSN"/> 
		<input type="hidden" name="Facebook" value="' . $student->getFacebook() . '"/>
		<input type="hidden" name="Twitter" value="' . $student->getTwitter() . '"/>
		<input type="hidden" name="Portable" value="' . $student->getPortable() . '"/>
		<input type="hidden" name="Skype" value="' . $student->getSkype() . '"/>
		<input type="hidden" name="MSN" value="' . $student->getMsn() . '"/>
		<p id="resultats_sociaux"></p>
	</div>';
	
	}

/* ************ searchAndPrintStudents() ************
 * 
 * Recherche et affiche les etudiants trouves
 * 
 */

	function searchAndPrintStudents($p_recherche, $p_initial=false){
	
		$easterEgg = 0;
	
		$BDD = new BDD();
		
		if($p_initial == true || $p_recherche == ""){
		
			$students = $BDD->select(
				"student_idbooster",
				"TB_STUDENTS",
				"ORDER BY student_visites DESC LIMIT 0,28"
			);
					
		} elseif($p_recherche == "300") {

			$easterEgg = 1;
			
		} else {
		
			$p_recherche = strtoupper($p_recherche);
										
			$students = $BDD->select(
				"student_idbooster",
				"TB_STUDENTS",
				"WHERE 
					student_idbooster LIKE CONCAT('%',CONCAT(?, '%')) OR  
					UPPER(student_nom) LIKE CONCAT('%',CONCAT(?, '%')) OR
					UPPER(student_prenom) LIKE CONCAT('%',CONCAT(?, '%')) OR
					CONCAT(CONCAT(UPPER(student_prenom),' '), UPPER(student_nom)) LIKE CONCAT('%',CONCAT(?, '%')) OR
					CONCAT(CONCAT(UPPER(student_nom),' '), UPPER(student_prenom)) LIKE CONCAT('%',CONCAT(?, '%')) OR
					student_promo = ?
				ORDER BY student_nom LIMIT 0,28",
				array($p_recherche, $p_recherche, $p_recherche, $p_recherche, $p_recherche, $p_recherche)
			);
			
		}
		
		if(count($students) == 0){
			if($easterEgg == 1){
				echo "<img class='students_found' title='300' src='http://www.campus-booster.net/actorpictures/300.jpg'/>";
			} else {
				echo "<p id='recherche_vide'>Aucun étudiant n'a pu être trouvé.</p>";
			}
		} else {
			foreach($students as $student){
				echo "<img class='students_found' 
					title='".$student->student_idbooster."' 
					src='http://www.campus-booster.net/actorpictures/".$student->student_idbooster.".jpg'/>";	
			}
		}
	
	}

/* ************ getNombreNews() ************
 * 
 * Renvoit le nombre total de news - 1
 * 
 * @return int nombre news - 1
 *
 */

	function getNombreNews(){
	
		$BDD = new BDD();
	
		$count = $BDD->select(
			"COUNT(*) AS NB",
			"TB_NEWS",
			""
		);
		
		return $count[0]->NB - 1;
	
	}
	
/* ************ getThisNew() ************
 * 
 * Renvoit la news correspondante au parametre
 * 
 * @return objet contenant toutes les infos de la news
 *
 */

	function getThisNew($pagenews){
	
		$BDD = new BDD();
	
		$news = $BDD->select(
			"*",
			"TB_NEWS",
			"ORDER BY news_id DESC LIMIT ".$pagenews.",1"
		);
		
		$auteur = new Student($news[0]->news_auteur);
		
		$news[0]->news_auteur = $auteur;
		
		return $news[0];
	
	}

/* ************ majPassword() ************
 * 
 * Met à jour le mot de passe d'un etudiant
 *
 */
 
	function majPassword($p_idbooster, $p_old_mdp, $p_new_mdp, $p_confirmation_mdp){
	
		if(checkUserLogin($p_idbooster, md5($p_old_mdp))){
			if($p_new_mdp == $p_confirmation_mdp){
			
				$BDD = new BDD();
		
				$BDD->update(
					"TB_STUDENTS",
					array("student_pass = ?"),
					"student_idbooster = ?",
					array(md5($p_new_mdp), $p_idbooster)
				);
				
				return true;
			
			} else {
				return false;
			}
		} else {
			return false;			
		}
	
	}


/* ************ majInformationsStudent() ************
 * 
 * Met à jour les informations d'un student
 *
 */
 
	function majInformationsStudent($p_idbooster, $p_facebook, $p_twitter, $p_skype, $p_msn, $p_portable){
		
		$BDD = new BDD();
		
		$BDD->update(
			"TB_STUDENTS",
			array("student_facebook = ?","student_twitter = ?","student_skype = ?","student_msn = ?","student_portable = ?"),
			"student_idbooster = ?",
			array($p_facebook, $p_twitter, $p_skype, $p_msn, $p_portable, $p_idbooster)
		);
	
	}

/* ************ majVisites() ************
 * 
 * Met à jour le nombre de visite et la date de dernière visite d'un eleve
 *
 */
 
	function majVisites($p_idbooster){
		
		$BDD = new BDD();
		
		$visite = $BDD->select(
			"student_derniere_visite",
			"TB_STUDENTS",
			"WHERE student_idbooster = ?",
			array($p_idbooster)
		);
		
		if($visite[0]->student_derniere_visite != date('Y-m-d')){
			
			$BDD->update(
				"TB_STUDENTS",
				array("student_derniere_visite = CURRENT_TIMESTAMP()","student_visites = student_visites + 1"),
				"student_idbooster = ?",
				array($p_idbooster)
			);
			
		} 
	
	}

/* ************ checkUserLogin() ************
 * 
 * Renvoit un booleen pour confirmer ou non la connexion
 * 
 * @return bool
 *
 */
 
	function checkUserLogin($p_login, $p_pass, $check_cookies=false){	
	
		$BDD = new BDD();
		
		if(!$check_cookies){
		
			$nb = $BDD->select(
				"COUNT(*) AS NB",
				"TB_STUDENTS",
				"WHERE student_idbooster = ? AND student_pass = ? AND student_autorisation != 0",
				array($p_login,$p_pass)
			);
		
			if($nb[0]->NB == 1){
				return true;
			} else {
				return false;
			}
		
		} else {
		
			$user = $BDD->select(
				"student_pass",
				"TB_STUDENTS",
				"WHERE student_idbooster = ? AND student_autorisation != 0",
				array($p_login)
			);
			
			if(md5(GBL_SEL).$user[0]->student_pass == $p_pass){
				return true;
			} else {
				return false;
			}
		
		}
	
	}



/***********************************************************PAGE ENTRAIDE**************************************************
/* ************ getAllEntraides() ************
 * 
 * Renvoit toutes les questions d'entraide
 *
 * @return array toutes les questions d'entraide
 *
 */

	function getAllEntraides(){
	
		$BDD = new BDD();
	
		$entraides = $BDD->select(
			"entraide_id, entraide_question, entraide_auteur, entraide_details, entraide_resolu, DATE_FORMAT(entraide_date, '%d/%b/%Y') as entraide_date",
			"TB_ENTRAIDES",
			"ORDER BY entraide_date DESC, entraide_id DESC"
		);
	
		return $entraides;
	
	}


/* ************ getNonRepEntraides() ************
 * 
 * Renvoit toutes les questions d'entraide non repondues
 *
 * @return array toutes les questions d'entraide non repondues
 *
 */

	function getNonRepEntraides(){
	
		$BDD = new BDD();
	
		$entraides = $BDD->select(
			"entraide_id, entraide_question, entraide_auteur, entraide_details, entraide_resolu, DATE_FORMAT(entraide_date, '%d/%b/%Y') as entraide_date",
			"TB_ENTRAIDES",
			"WHERE entraide_resolu = 0 ORDER BY entraide_date DESC, entraide_id DESC"
		);
	
		return $entraides;
	
	}
	
/* ************ getRepEntraides() ************
 * 
 * Renvoit toutes les questions d'entraide repondues
 *
 * @return array toutes les questions d'entraide repondues
 *
 */

	function getRepEntraides(){
	
		$BDD = new BDD();
	
		$entraides = $BDD->select(
			"entraide_id, entraide_question, entraide_auteur, entraide_details, entraide_resolu, DATE_FORMAT(entraide_date, '%d/%b/%Y') as entraide_date",
			"TB_ENTRAIDES",
			"WHERE entraide_resolu = 1 ORDER BY entraide_date DESC, entraide_id DESC"
		);
	
		return $entraides;
	
	}
	

/* ************ getReponses() ************
 * 
 * Renvoit toutes les reponses
 *
 * @return array toutes les reponses
 *
 */

	function getReponses($entraideid){
	
		$BDD = new BDD();
	
		$reponses = $BDD->select(
			"entraide_reponse_id, entraide_id, entraide_reponse, entraide_reponse_auteur, DATE_FORMAT(entraide_reponse_date, '%d/%b/%Y') as entraide_reponse_date",
			"TB_ENTRAIDES_REPONSES",
			"WHERE entraide_id = ? ORDER BY entraide_reponse_date, entraide_reponse_id",
			array($entraideid)
		);
	
		return $reponses;
	
	}


/* ************ AddQuestion() ************
 * 
 * Ajoute une question
 *
 * @return bool reussi ou non
 *
 */

	function AddQuestion(){
	
		$BDD = new BDD();
		$studentpn =  $_COOKIE['prenom'] . " " . $_COOKIE['nom'];
		
		if ((isset($_POST[question]) && isset($_POST[details])) && $_POST[question] != "" && $_POST[question] != "Entrez votre Question ici...") {
	
			$BDD->insert(
				"TB_ENTRAIDES",
				array("entraide_question","entraide_auteur","entraide_date","entraide_details"),
				array("?","?","CURRENT_TIMESTAMP()","?"),
				array(htmlspecialchars(stripslashes(utf8_decode($_POST[question]))), $studentpn, htmlspecialchars(stripslashes(utf8_decode($_POST[details]))))
			);
			
			$success = true;	
		}
		else { $success = false; }
	
		return $success;
	
	}


/* ************ AddReponse() ************
 * 
 * Ajoute une reponse à une question
 *
 * @return bool reussi ou non
 *
 */

	function AddReponse(){
	
		$BDD = new BDD();
		$studentpn =  $_COOKIE['prenom'] . " " . $_COOKIE['nom'];
		
		if (isset($_POST[reponse]) && $_POST[reponse] != "") {
	
			$BDD->insert(
				"TB_ENTRAIDES_REPONSES",
				array("entraide_reponse","entraide_reponse_auteur","entraide_reponse_date", "entraide_id"),
				array("?","?","CURRENT_TIMESTAMP()","?"),
				array(htmlspecialchars(stripslashes(utf8_decode($_POST[reponse]))), $studentpn, $_POST[entraideid])
			);
			
			$success = true;	
		}
		else { $success = false; }
	
		return $success;
	
	}

/* ************ OkQuestion() ************
 * 
 *Verifie l'auteur et Valide une question
 *
 * 
 *
 */

	function OkQuestion(){
	
		$BDD = new BDD();
		$studentpn =  $_COOKIE['prenom'] . " " . $_COOKIE['nom'];
		
		$verif = $BDD->select(
			"entraide_auteur",
			"TB_ENTRAIDES",
			"WHERE entraide_id = ?",
			array($_GET[id])
		);
		
		if ($verif[0]->entraide_auteur == $studentpn) {
	
				$BDD->update(
					"TB_ENTRAIDES",
					array("entraide_resolu = 1"),
					"entraide_id = ?",
					array($_GET[id])
				);			
			
		}
	
	}

?>