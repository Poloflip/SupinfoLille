<?php

/* ************ creerEvenement() ************
 * 
 * Crée un evenement
 * 
 */

	function creerEvenement($p_titre, $p_ss_titre, $p_date, $p_description){
	
		$BDD = new BDD();
	
		$BDD->insert(
			"TB_EVENEMENTS",
			array("evenement_titre","evenement_ss_titre","evenement_date","evenement_description"),
			array("?","?","?","?"),
			array($p_titre, $p_ss_titre, $p_date, $p_description)
		);
	}

/* ************ supprimerEvenement() ************
 * 
 * Supprime un evenement
 * 
 */

	function supprimerEvenement($p_id){
	
		$BDD = new BDD();
	
		$BDD->delete(
			"TB_EVENEMENTS",
			"evenement_id = ?",
			array($p_id)
		);
		
		$BDD->delete(
			"TB_EVENEMENTS_PARTICIPATIONS",
			"evenement_id = ?",
			array($p_id)
		);
	
	}

/* ************ updateEvenement() ************
 * 
 * Met un jour un evenement
 * 
 */

	function updateEvenement($p_id, $p_titre, $p_ss_titre, $p_date, $p_description){
		
		$BDD = new BDD();
	
		$BDD->update(
			"TB_EVENEMENTS",
			array("evenement_titre = ?", "evenement_ss_titre = ?", "evenement_date = ?", "evenement_description = ?"),
			"evenement_id = ?",
			array($p_titre, $p_ss_titre, $p_date, $p_description, $p_id)
		);
					
	}
	
/* ************ printCreationEvenement() ************
 * 
 * Affiche le formulaire de creation d'event
 *
 */

	function printCreationEvenement(){
		
		echo "<form action='evenements.php' method='post'>";
		echo "<strong>Titre : </strong> <input type='text' name='titre'/> <br/><br/>";
		echo "<strong>Sous-Titre : </strong> <input type='text' name='ss_titre'/> <br/><br/>";
		echo "<strong>Date : </strong> <input type='text' name='date'/> <br/><br/>";
		echo "<strong>Description : </strong> <br/><br/> <textarea name='description'></textarea>";
		echo "<p style='text-align:center'><input type='submit' value='Créer'/><p>";
		echo "</form>";
		
	}
/* ************ printEditionEvenement() ************
 * 
 * Affiche le formulaire d'edition pour l'evenement en param
 *
 */

	function printEditionEvenement($p_evenement_id){
		
		$BDD = new BDD();
	
		$evenement = $BDD->select(
			"*",
			"TB_EVENEMENTS",
			"WHERE evenement_id = ?",
			array($p_evenement_id)
		);
		
		echo "<form action='entraide.php' method='post'>";
		echo "<strong>Titre : </strong> <input type='text' name='titre' value='".$evenement[0]->evenement_titre."'/> <br/><br/>";
		echo "<strong>Sous-Titre : </strong> <input type='text' name='ss_titre' value='".$evenement[0]->evenement_ss_titre."'/> <br/><br/>";
		echo "<strong>Date : </strong> <input type='text' name='date' value='".$evenement[0]->evenement_date."'/> <br/><br/>";
		echo "<strong>Description : </strong> <br/><br/> <textarea name='description'>".$evenement[0]->evenement_description."</textarea>";
		echo "<input type='hidden' name='id' value='".$evenement[0]->evenement_id."'/>";
		echo "<p style='text-align:center'><input type='submit' value='Éditer'/><p>";
		echo "</form>";
		
	}
	
/* ************ getIdDernierEvenement() ************
 * 
 * Retourne l'ID du dernier event
 * 
 * @return int id dernier event
 *
 */
	
	function getIdDernierEvenement(){
	
		$BDD = new BDD();
	
		$evenement = $BDD->select(
			"evenement_id",
			"TB_EVENEMENTS",
			"ORDER BY evenement_date DESC, evenement_id DESC LIMIT 0,1",
			array($p_evenement_id)
		);
	
		return $evenement[0]->evenement_id;	
	}

/* ************ getMeilleursDocumentsTelechargements() ************
 * 
 * Renvoit la liste des documents les plus telecharger
 * 
 * @return array listes documents
 *
 */

	function getMeilleursDocumentsTelechargements($p_nb){
		
		$BDD = new BDD();
	
		$documents = $BDD->select(
			"d.document_nom, d.document_telechargements, m.matiere_nom, m.matiere_cursus",
			"TB_DOCUMENTS d JOIN TB_MATIERES m ON (d.matiere_id = m.matiere_id)",
			"ORDER BY d.document_telechargements DESC, m.matiere_cursus, m.matiere_nom, d.document_nom
			 LIMIT 0,".$p_nb
		);
		
		return $documents;
	
	}

/* ************ getMeilleursStudentsVisites() ************
 * 
 * Renvoit la liste des etudiants venus le plus souvent
 * 
 * @return array listes students
 *
 */

	function getMeilleursStudentsVisites($p_nb){
		
		$BDD = new BDD();
	
		$students = $BDD->select(
			"student_idbooster, student_nom, student_prenom, student_visites",
			"TB_STUDENTS",
			"ORDER BY student_visites DESC LIMIT 0,".$p_nb
		);
		
		return $students;
	
	}

/* ************ getStudentsVisiteAujourdhui() ************
 * 
 * Renvoit la liste des etudiants venus aujourd'hui
 * 
 * @return array listes students
 *
 */

	function getStudentsVisiteAujourdhui(){
		
		$BDD = new BDD();
	
		$students = $BDD->select(
			"student_idbooster, student_nom, student_prenom",
			"TB_STUDENTS",
			"WHERE student_derniere_visite = CURDATE()"
		);
		
		return $students;
	
	}

/* ************ initStudentPass() ************
 * 
 * Initialise le password du student en parametre
 * 
 */

	function initStudentPass($p_idbooster){
	
		$chaine = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@";
		$nb_caract = 6;
		$passClair = "";
		for($u = 1; $u <= $nb_caract; $u++) {
    		$nb = strlen($chaine);
    		$nb = mt_rand(0,($nb-1));
    		$passClair.=$chaine[$nb];
    	}
    	
    	$pass = md5($passClair);
		
		$BDD = new BDD();
	
		$BDD->update(
			"TB_STUDENTS",
			array("student_pass = ?"),
			"student_idbooster = ?",
			array($pass, $p_idbooster)
		);
		
		return $passClair;
			
	}

/* ************ modifierStudentInfos() ************
 * 
 * Modifie les informations des students
 * 
 */

	function modifierStudentInfos($p_idbooster, $p_what, $p_new){
		
		$BDD = new BDD();
	
		$BDD->update(
			"TB_STUDENTS",
			array("student_".$p_what." = ?"),
			"student_idbooster = ?",
			array($p_new, $p_idbooster)
		);
			
	}

/* ************ printStudentProfileToEdit() ************
 * 
 * Affiche le profile du student correspondant au booster
 * 
 */

	function printStudentProfileToEdit($p_idbooster){
	
	$student = new Student($p_idbooster);
	
	echo "<h2>". $student->getPrenom() . " " . $student->getNom() ." <div id='boosterEdit'>" . $student->getIdbooster() . "</div></h2>";
	
	echo '<div id="identite">
		<img src="http://www.campus-booster.net/actorpictures/' . $student->getIdbooster() . '.jpg"/>
	</div>';
				
	echo "<div id='identite2'><br/>
		<img src='../images/promo.png' title='Promotion'/> 
		<span>Promotion : <strong id='EditPromotion'>" . $student->getPromo() . "</strong> </span>
			<br/>
		<img src='../images/status.png' title='Status'/>
		<span>Status : <strong id='EditAutorisation'>" . $student->getAutorisation() . "</strong> </span>
			<br/>
		<img src='../images/visites.png' title='Visites'/> 
		<span>Visites : <strong id='EditVisites'>" . $student->getVisites() . "</strong> </span>
	</div>";
					
	echo '<div id="compte_infos"><br/>
	 	<p>Cliquez sur le bouton pour réinitialiser le mot de passe</p>
		<p id="initPass" style="text-align:center"><input type="button" value="Réinitialiser" title="'.$student->getIdbooster().'"/></p>
		<p id="newPass"></p>
	</div>';
	
	}


/* ************ getNbMatieres() ************
 * 
 * Renvoit le nombre de matieres
 * 
 * @return int nb de matieres
 *
 */

	function getNbMatieres(){
	
		$BDD = new BDD();
	
		$NB = $BDD->select(
			"COUNT(*) AS NB",
			"TB_MATIERES"
		);
	
		return $NB[0]->NB;
	
	}

/* ************ getNbDocuments() ************
 * 
 * Renvoit le nombre de documents
 * 
 * @return int nb de documents
 *
 */

	function getNbDocuments($p_cursus){
	
		$BDD = new BDD();
	
		$NB = $BDD->select(
			"COUNT(*) AS NB",
			"TB_DOCUMENTS d JOIN TB_MATIERES m ON (d.matiere_id = m.matiere_id)",
			"WHERE m.matiere_cursus LIKE '".$p_cursus."'"
		);
	
		return $NB[0]->NB;
	
	}

/* ************ getNbTelechargements() ************
 * 
 * Renvoit le nombre de telechargements
 * 
 * @return int nb de telechargement
 *
 */

	function getNbTelechargements(){
	
		$BDD = new BDD();
	
		$NB = $BDD->select(
			"SUM(document_telechargements) AS NB",
			"TB_DOCUMENTS"
		);
	
		return $NB[0]->NB;
	
	}


/* ************ desactiverDocument() ************
 * 
 * Desactive un document de la BDD
 * 
 */

	function desactiverDocument($p_id){
	
		$BDD = new BDD();
	
		$BDD->update(
			"TB_DOCUMENTS",
			array("document_status = 0"),
			"document_id = ?",
			array($p_id)
		);
	
	}

/* ************ validerDocument() ************
 * 
 * Valide un document dans la BDD, et le range sur le serveur comme il le faut
 * 
 */

	function validerDocument($p_id, $p_chemin, $p_cursus, $p_matiere){
	
		$BDD = new BDD();
	
		$BDD->update(
			"TB_DOCUMENTS",
			array("document_status = 1"),
			"document_id = ?",
			array($p_id)
		);
		
		$origine = "../uploads/".$p_chemin;
		$direction = "../documents/".$p_cursus."/".$p_matiere;
		
		$deplacement = "mv ".$origine." ".$direction;
						
		exec($deplacement);
	
	}

/* ************ modifierNomDocument() ************
 * 
 * Modifie le nom d'un document dans la BDD
 * 
 */

	function modifierNomDocument($p_id, $p_new){
	
		$BDD = new BDD();
	
		$BDD->update(
			"TB_DOCUMENTS",
			array("document_nom = ?"),
			"document_id = ?",
			array($p_new, $p_id)
		);
	
	}

/* ************ supprimerDocument() ************
 * 
 * Supprime un document de la BDD et du serveur
 * 
 */

	function supprimerDocument($p_id, $p_cursus){
	
		$BDD = new BDD();
	
		$document = $BDD->select(
			"*",
			"TB_DOCUMENTS",
			"WHERE document_id = ?",
			array($p_id)
		);
				
		if($document[0]->document_status == 0){
		
			$chemin = "../uploads/".$document[0]->document_chemin;
		
		} else {
		
			$chemin = "../documents/".$p_cursus."/".$document[0]->matiere_id."/".$document[0]->document_chemin;
			
		}
				
		exec("rm " . $chemin);
	
		$BDD->delete(
			"TB_DOCUMENTS",
			"document_id = ?",
			array($p_id)
		);			
	}

/* ************ ajouterMatiere() ************
 * 
 * Ajoute une matiere dans la BDD
 * 
 */

	function ajouterMatiere($p_nom, $p_nom_complet, $p_cursus){
	
		$BDD = new BDD();
	
		$BDD->insert(
			"TB_MATIERES",
			array("matiere_nom","matiere_nom_complet","matiere_cursus"),
			array("?","?","?"),
			array($p_nom, $p_nom_complet, $p_cursus)
		);
		
	}

/* ************ getAllDocuments() ************
 * 
 * Renvoit tous les documents disponnibles
 * 
 * @return array tous les documents
 *
 */

	function getAllDocuments($p_cursus, $p_page){
	
		$page = ($p_page-1)*10;
	
		$BDD = new BDD();
	
		$documents = $BDD->select(
			"d.document_id, d.document_nom, d.document_chemin, d.document_telechargements, d.document_status, d.student_id, 
			m.matiere_nom, m.matiere_cursus, m.matiere_id",
			"TB_DOCUMENTS d JOIN TB_MATIERES m ON (d.matiere_id = m.matiere_id)",
			"WHERE m.matiere_cursus LIKE '".$p_cursus."' 
			 ORDER BY d.document_status, m.matiere_cursus, m.matiere_nom, d.document_nom
			 LIMIT ".$page.",10"
		);
	
		return $documents;
	
	}
	
	
	
	/* ************ printEditionEntraide() ************
 * 
 * Affiche le formulaire d'edition pour l'entraide en param
 *
 */

	function printEditionEntraide($p_entraide_id){
		
		$BDD = new BDD();
	
		$entraide = $BDD->select(
			"*",
			"TB_ENTRAIDES",
			"WHERE entraide_id = ?",
			array($p_entraide_id)
		);
		
		echo "<form action='entraide.php' method='post'>";
		echo "<strong>Question : </strong> <textarea name='question'>".utf8_encode($entraide[0]->entraide_question)."</textarea><br/><br/>";
		echo "<strong>Détails : </strong> <textarea name='details' />".$entraide[0]->entraide_details."</textarea><br/><br/>";
		echo "<strong>Date : </strong> <input type='text' name='date' value='".$entraide[0]->entraide_date."'/> <br/><br/>";
		echo "<input type='hidden' name='id' value='".$entraide[0]->entraide_id."'/>";
		echo "<p style='text-align:center'><input type='submit' value='Éditer'/><p>";
		echo "</form>";
		
	}
	
/* ************ getIdDernierEntraide() ************
 * 
 * Retourne l'ID de la derniere entraide
 * 
 * @return int id derniere entraide
 *
 */
	
	function getIdDernierEntraide(){
	
		$BDD = new BDD();
	
		$entraide = $BDD->select(
			"entraide_id",
			"TB_ENTRAIDES",
			"ORDER BY entraide_date DESC, entraide_id DESC LIMIT 0,1",
			array($p_entraide_id)
		);
	
		return $entraide[0]->entraide_id;	
	}

/* ************ creerentraide() ************
 * 
 * Crée un entraide
 * 
 */

	function creerEntraide($p_question, $p_details, $p_date){
	
		$BDD = new BDD();
	
		$BDD->insert(
			"TB_ENTRAIDES",
			array("entraide_question","entraide_details","entraide_date"),
			array("?","?","?","?"),
			array(htmlspecialchars(stripslashes(utf8_decode($p_question))), htmlspecialchars(stripslashes(utf8_decode($p_details))), $p_date)
		);
	}

/* ************ supprimerEntraide() ************
 * 
 * Supprime une entraide
 * 
 */

	function supprimerEntraide($p_id){
	
		$BDD = new BDD();
	
		$BDD->delete(
			"TB_ENTRAIDES",
			"entraide_id = ?",
			array($p_id)
		);
		
		$BDD->delete(
			"TB_ENTRAIDES_REPONSES",
			"entraide_id = ?",
			array($p_id)
		);
	
	}

/* ************ updateEntraide() ************
 * 
 * Met un jour une entraide
 * 
 */

	function updateEntraide($p_id, $p_question, $p_details, $p_date){
		
		$BDD = new BDD();
	
		$BDD->update(
			"TB_ENTRAIDES",
			array("entraide_question = ?", "entraide_details = ?", "entraide_date = ?"),
			"entraide_id = ?",
			array(htmlspecialchars(stripslashes(utf8_decode($p_question))), htmlspecialchars(stripslashes(utf8_decode($p_details))), $p_date, $p_id)
		);
					
	}
?>