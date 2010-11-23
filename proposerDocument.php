<?php

	require_once("inclusions/haut.php");

	$matieres = getAllMatieres();
		
?>

<div id="proposerDocument">

	<h2>Proposer un document<div><img src='images/ajax-loader.gif'/></div></h2>
	
	<p id="texteProposer">Pour proposer un document, il vous suffit de choisir la matière correspondante, son nom, puis de choisir votre fichier.<br/>
	Une fois toutes les informations renseignées, cliquez sur "Proposer mon document". Ainsi votre document sera uploadé sur notre serveur et sera proposé aux administrateurs.</p>

	<strong>Matière de votre document :</strong> <select id="file_matiere" name="matiere">
		<optgroup label="B1">
			<?php
				foreach($matieres as $matiere){
					if($matiere->matiere_cursus == "B1"){
						echo '<option value="'. $matiere->matiere_id .'">'. $matiere->matiere_nom_complet .'</option>';
					}
				}
			?>
		</optgroup>
		<optgroup label="B2">
			<?php
				foreach($matieres as $matiere){
					if($matiere->matiere_cursus == "B2"){
						echo '<option value="'. $matiere->matiere_id .'">'. $matiere->matiere_nom_complet .'</option>';
					}
				}
			?>
		</optgroup>
		<optgroup label="B3">
			<?php
				foreach($matieres as $matiere){
					if($matiere->matiere_cursus == "B3"){
						echo '<option value="'. $matiere->matiere_id .'">'. $matiere->matiere_nom_complet .'</option>';
					}
				}
			?>
		</optgroup>
	</select><br/><br/>

	<strong>Nom de votre document :</strong> <input id="file_name" type="text" name="file_name"/><br/><br/>
	<strong>Choisissez votre fichier :</strong><input id="file_upload" name="file_upload" type="file" />
	<p style="text-align:center">
		<input id="button_file_upload" type="button" value="Proposer mon document"/>
	</p>
	
</div>

<div id="derniersDocuments">

	<h2>Derniers documents</h2>
	
	<ul>
	
		<?php
	
		$documents = getDerniersDocuments();
	
		foreach($documents as $document){
	
			echo "<li>". $document->document_nom ."</li>";
	
		}
	
		?>
		
	</ul>

</div>
	
<?php

	require_once("inclusions/bas.php");

?>

