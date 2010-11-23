<?php

session_start();

require_once('../../configuration.php');
require_once('../../auto_chargement_classes.php');
require_once("../../fonctions.php");

$student = new Student($_SESSION['idbooster']);

$user =  $student->getPrenom() . " " . $student->getNom();

$file = 'chatbox.php'; // fichier de stockage
$max_lines = 10000000;    // nombre de lignes maximum stockées

$newtext = wordwrap(htmlspecialchars(stripslashes($_POST['message'])), 46, "\n", true);

if (isset($_POST['message']) && $_POST['message'] != NULL ) {    
    $message  = $newtext;
    $date     = date('d/m/y H:i:s');
    $new_line = "<dt><b>{$user}</b> {$date}</dt><dd>{$message}</dd>\n";
    $content  = file($file);    
    $content  = array_slice($content, 0, $max_lines);
    array_push($content, $new_line);
    file_put_contents($file, $content);
}

?>