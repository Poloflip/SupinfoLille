	</div>

</div>

	<div id="wrapfooter">
	<div id="footer">
                <div id="liens">
                <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="news.php">News</a></li>
                <li><a href="stats.php">Statistiques</a></li>
                <li><a href="documents.php">Documents</a></li>
                <li><a href="etudiants.php">Étudiants</a></li>
                <li><a href="evenements.php">Evénements</a></li>
                <li><a href="sondages.php">Sondages</a></li>
                <li><a href="entraide.php">Entraide</a></li>
                <?php if ($_COOKIE[status] == 2) { echo "<li><a href='../'>Retour au Site</a></li>"; } ?>
                </ul>
            </div>
	</div>
	</div>

</body>
</html>
