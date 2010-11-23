<?php

	require_once('../inclusions/configuration.php');
	require_once('../inclusions/auto_chargement_classes.php');
	require_once("../inclusions/fonctions.php");
	require_once("inclusions/fonctions.php");
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>SUPINFO Lille 2013</title>
	<link rel="stylesheet" type="text/css" href="../../inclusions/css/main.css" />
    <link rel="stylesheet" type="text/css" href="../../inclusions/css/jquery-ui/jquery-ui-1.8.5.custom.css" /> 
	<link type="text/css" rel="stylesheet" href="../../chat/chat.css" />
    <link type="text/css" rel="stylesheet" href="inclusions/css/admin.css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js"></script>
    	<script type="text/javascript" src="../../inclusions/javascript/jquery-ui-1.8.5.custom.min.js"></script>
    <script type="text/javascript" src="inclusions/javascript/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="inclusions/javascript/admin.js"></script>
</head>

<body>

<div id="wrapper">

<div id="logo" onclick="location.href='index.php'"></div>
	<div id="menu"><div id="encartmenu">
    <div id="photo-haut"><?php echo '<a href="../moncompte.php"><img src="http://www.campus-booster.net/actorpictures/' . $_COOKIE['idbooster'] . '.jpg" style="height:60px;-moz-border-radius:10px; -webkit-border-radius:10px; border:3px solid white;"/></a>'; ?></div> <div id="textmenu"><p><a href="../moncompte.php">Mon compte</a><?php if ($_COOKIE[status] == 2) { echo "<span>-</span><span><a href='../index.php'>Retour au Site</a></span>"; } ?><span>-</span><span><a href="../deconnexion.php">Déconnexion()</a></span></p></div></div>
    </div>
</div>

<div id="fondblanc">
	
	<div id="subwrapper">