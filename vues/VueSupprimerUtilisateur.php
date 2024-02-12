<?php
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Site MVC</title>
<link rel="stylesheet" href="styles.css" type="text/css">
<link rel="stylesheet" href="stylesAffichageMessage.css" type="text/css">
<script language="javascript" type="text/javascript" src="scriptAffichageMessage.js"></script>
<script>
// dès que la page est chargée (événement onload), la fonction initialisations est exécutée
window.onload = initialisations;
// la fonction initialisations appelée à la fin du chargement de la page
function initialisations() {
// affichage du message préparé par le contrôleur avec une fenêtre modale 
// activée en JavaScript au chargement de la page
<?php if ($typeMessage == 'avertissement') { ?>
afficher_avertissement("<?php echo $message; ?>");
<?php } ?>
<?php if ($typeMessage == 'information') { ?>
afficher_information("<?php echo $message; ?>");
<?php } ?>
}
</script>
</head>
<body>
	<div id="page">
		<h3>Supprimer un utilisateur</h3>
		<form id="formConnexion" name="formConnexion" method="post" action="index.php?action=SupprimerUtilisateur" >
			<p>
				<label for="txtLogin">Login :</label>
				<input type="text" id="txtLogin" name="txtLogin" required value="<?php echo $login; ?>" />
			</p>
			<p><input type="submit" id="btnEnvoyer" name="btnEnvoyer" value="Envoyer" />
			<p><a href="index.php?action=Connecter" class="bouton-menu">Retour à la page de connexion</a></p>
			<p id="message-erreur"><?php echo $message; ?></p>
		</form>
	</div>
	<aside id="affichage_message" class="classe_message">
<div>
<h2 id="titre_message" class="classe_information">Message</h2>
<p id="texte_message" class="classe_texte_message">Voici le texte du message</p>
<a href="#close" title="Fermer">Fermer</a>
</div>
</aside>
	
</body>
</html>
