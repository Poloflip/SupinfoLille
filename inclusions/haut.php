<?php

	session_start();

	require_once('inclusions/configuration.php');
	require_once('inclusions/auto_chargement_classes.php');
	require_once("inclusions/fonctions.php");
		
	if(isset($_COOKIE['idbooster']) && isset($_COOKIE['pass']) && isset($_COOKIE['nom']) 
		&& isset($_COOKIE['prenom']) && isset($_COOKIE['status'])){
		if($_SESSION['idbooster'] = $_COOKIE['idbooster']){
			if(!checkUserLogin($_COOKIE['idbooster'], $_COOKIE['pass'], true))
			{
				header('location: connexion.php');
			} else {
				majVisites($_COOKIE['idbooster']);
			}
		} else {
			header('location: connexion.php');
		}
	} else {
		header('location: connexion.php');
	}
		
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>SUPINFO Lille 2013</title>
	<link rel="stylesheet" type="text/css" href="inclusions/css/jquery-ui/jquery-ui-1.8.5.custom.css" />
	<link rel="stylesheet" type="text/css" href="inclusions/css/main.css" />
	<link type="text/css" rel="stylesheet" href="inclusions/javascript/chat/chat.css" />
	<link type="text/css" rel="stylesheet" href="inclusions/javascript/uploadify/uploadify.css"/>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js"></script>
	<script type="text/javascript" src="inclusions/javascript/jquery-ui-1.8.5.custom.min.js"></script>
	<script type="text/javascript" src="inclusions/javascript/chat/chat.js"></script>
	<script type="text/javascript" src="inclusions/javascript/uploadify/swfobject.js"></script>
	<script type="text/javascript" src="inclusions/javascript/uploadify/jquery.uploadify.v2.1.2.js"></script>
	<script type="text/javascript" src="inclusions/javascript/main.js"></script>
</head>

<body>

<div id="wrapper">

	<div id="logo" onclick="location.href='index.php'"></div>
	<div id="menu"><div id="encartmenu">
    <div id="photo-haut"><?php echo '<a href="moncompte.php"><img src="http://www.campus-booster.net/actorpictures/' . $_COOKIE['idbooster'] . '.jpg" style="height:60px;-moz-border-radius:10px; -webkit-border-radius:10px; border:3px solid white;"/></a>'; ?></div> <div id="textmenu"><p><a href="moncompte.php">Mon compte</a><?php if ($_COOKIE[status] == 2) { echo "<span>-</span><span><a href='/administration'>Administration</a></span>"; } ?><span>-</span><span><a href="deconnexion.php">Déconnexion</a></span></p></div></div>
    </div>

</div>

<div id="fondblanc">
	
	<div id="subwrapper">