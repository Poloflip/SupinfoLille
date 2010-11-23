<?php

	session_start();

	require_once("inclusions/configuration.php");
	require_once("inclusions/auto_chargement_classes.php");
	require_once("inclusions/fonctions.php");

	$fail = false;
	
	if(isset($_COOKIE['idbooster']) && isset($_COOKIE['pass']) && isset($_COOKIE['nom']) 
		&& isset($_COOKIE['prenom']) && isset($_COOKIE['status'])){
		if($_SESSION['idbooster'] = $_COOKIE['idbooster']){
			if(checkUserLogin($_COOKIE['idbooster'], $_COOKIE['pass'],true))
			{
				header('location: index.php');
			}
		}
	}

	if(isset($_POST['idbooster']) && isset($_POST['pass']))
	{
		if(checkUserLogin($_POST['idbooster'],md5($_POST['pass']))){
			$student = new Student($_POST['idbooster']);
			majVisites($_POST['idbooster']);
			setcookie('idbooster', $_POST['idbooster'], time() + 31*24*3600);
			setcookie('pass', md5(GBL_SEL).md5($_POST['pass']), time() + 31*24*3600);
			setcookie('nom', $student->getNom(), time() + 31*24*3600);
			setcookie('prenom', $student->getPrenom(), time() + 31*24*3600);
			setcookie('status', $student->getAutorisation(), time() + 31*24*3600);
			$_SESSION['idbooster'] = $_POST['idbooster'];
			header('location: index.php');
		} else {
			$fail = true;
		}
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>SUPINFO Lille 2013</title>
    <!---- Benji sucks ! ----->
	<link rel="stylesheet" type="text/css" href="inclusions/css/jquery-ui/jquery-ui-1.8.5.custom.css" />
	<link rel="stylesheet" type="text/css" href="inclusions/css/main.css" />
	<link type="text/css" rel="stylesheet" href="inclusions/javascript/chat/chat.css" />
	<link type="text/css" rel="stylesheet" href="inclusions/javascript/uploadify/uploadify.css"/>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.js"></script>
	<script type="text/javascript" src="inclusions/javascript/jquery-ui-1.8.5.custom.min.js"></script>
	<script type="text/javascript" src="inclusions/javascript/chat/chat.js"></script>
	<script type="text/javascript" src="inclusions/javascript/uploadify/swfobject.js"></script>
	<script type="text/javascript" src="inclusions/javascript/uploadify/jquery.uploadify.v2.1.2.js"></script>
	<script type="text/javascript" src="inclusions/javascript/main.js"></script>
    <script type="text/javascript">
		
	jQuery(document).ready(function() {	
		
		jQuery("#drop").click(function(){
			jQuery("#vid").slideToggle("slow");
		});
		
	});
	
	</script>
    <style> 
    body { 
    	background:url(../../images/bg.jpg) repeat-x #1e2126; 
    }
    
    #vid
    {
    	display: none;
    }
    </style>
</head>

<body>

<div id="wrapper">

	<div id="logo"></div>
	<div id="menu"></div>

</div>

<div id="top_connexion" style="clear:both;">
</div>

<div id="connexion">
	<form action="connexion.php" method="post">
		<?php
			if($fail){
				echo '<p id="echec_connexion">Échec de la connexion, veuillez réessayer.</p>';
			}
		?>
		<fieldset>
			<legend>Connexion</legend>
			<div>
				<input type="text" name="idbooster" value="ID Booster"/>
				<input type="password" name="pass" value="Mot De Passe"/><br/>
				<input type="submit" value="Connexion"/>
			</div>
		</fieldset>
	</form>
    
    <div id="video">
    <p style="text-align:center; color:white; cursor:pointer; font-size:12px;" id="drop">Voir la vidéo de présentation de SupinfoLille ▼</p>
	
	<div id="vid"><object classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,115,0' width='560' height='345'><param name='movie' value='http://screenr.com/Content/assets/screenr_1116090935.swf' /><param name='flashvars' value='i=132004' /><param name='allowFullScreen' value='true' /><embed src='http://screenr.com/Content/assets/screenr_1116090935.swf' flashvars='i=132004' allowFullScreen='true' width='560' height='345' pluginspage='http://www.macromedia.com/go/getflashplayer'></embed></object>
	</div>

	</div>
    
    
</div>

</body>
</html>


