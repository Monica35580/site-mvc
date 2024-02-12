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
// événement "onchange" de la case à cocher "caseAfficherMdp" associé à la fonction "afficherMdp"
document.getElementById("caseAfficherMdp").onchange = afficherMdp;
// place le focus sur la zone txtNouveauMdp au premier chargement de la page
document.getElementById("txtMdp").focus(); 
// affichage du message préparé par le contrôleur avec une fenêtre modale 
// activée en JavaScript au chargement de la page
<?php if ($typeMessage == 'avertissement') { ?>
afficher_avertissement("<?php echo $message; ?>");
<?php } ?>
<?php if ($typeMessage == 'information') { ?>
afficher_information("<?php echo $message; ?>");
<?php } ?>
}
// selon l'état de la case, le type des zones de saisie est "text" ou "password"
function afficherMdp()
{ if (document.getElementById("caseAfficherMdp").checked == true)
{ // l'utilisateur souhaite afficher en clair les mots de passe
document.getElementById("txtMdp").type="text";
document.getElementById("txtNouveauMdp").type="text";
document.getElementById("txtConfirmationMdp").type="text";
}
else
{ // l'utilisateur ne souhaite pas afficher en clair les mots de passe
document.getElementById("txtMdp").type="password";
document.getElementById("txtNouveauMdp").type="password";
document.getElementById("txtConfirmationMdp").type="password";
}
}
</script>
</head>
<body>
	<div id="page">
		<h3>Se connecter</h3>
		<form id="formConnexion" name="formConnexion" method="post" action="index.php?action=Connecter" >
			<p>
				<label for="txtLogin">Login :</label>
				<input type="text" id="txtLogin" name="txtLogin" pattern="^[a-zA-Z0-9]+$" required value="<?php echo $login; ?>" />
			</p>
			<p>
				<label for="txtMdp">Mot de passe :</label>
				<input type="password" id="txtMdp" name="txtMdp" required value="<?php echo $mdp; ?>" />
			</p>
			<p><input type="submit" id="btnEnvoyer" name="btnEnvoyer" value="Envoyer" />
			<p id="message-erreur"><?php echo $message; ?></p>
			<p>
				<label for="caseAfficherMdp">Afficher en clair :</label>
				<input type="checkbox" name="caseAfficherMdp" id="caseAfficherMdp"
                <?php if ($txtMdp == 'on') echo 'checked'; ?> >
                </p>
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