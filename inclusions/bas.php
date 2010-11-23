	</div>

</div>

	<div id="wrapfooter">
	<div id="footer">

	<div id="chat">
    	<div id="room"><dl></dl></div>
    	<form action="#" method="post">
    	    <input type="hidden" name="user" value="<?php echo $_COOKIE['prenom'] . " " . $_COOKIE['nom']; ?>" size="7"/>
    	    <input type="text" name="message" size="30" AUTOCOMPLETE="off" />
    	    <input type="submit" value="OK" />
    	</form>
	</div>


            <div id="liens">
                <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="moncompte.php">Mon compte</a></li>
                <li><a href="documents.php">Documents</a></li>
                <li><a href="etudiants.php">Étudiants</a></li>
                <li><a href="evenements.php">Evénements</a></li>
                <li><a href="sondages.php">Sondages</a></li>
                <li><a href="entraide.php">Entraide</a></li>
                <?php if ($_COOKIE[status] == 2) { echo "<li><a href='/administration'>Administration</a></li>"; } ?>
                </ul>
            </div>
	</div>
	</div>

</body>
</html>
