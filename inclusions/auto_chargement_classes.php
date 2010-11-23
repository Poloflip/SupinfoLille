<?php

/* Inclusion : auto_chargement_classes
 * 		Permet de charger automatiquement les classes utilisées
 * 		A inclure dans chaque page pour l'utiliser 
 */


/* ************ chargerClasse ($classe) ************ */

	function chargerClasse ($classe)
    {
        require 'Classes/' . $classe . '.class.php';
    }
    
    spl_autoload_register ('chargerClasse');

?>