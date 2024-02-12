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
//événement "submit" du formulaire "formModificationMdp" associé à la fonction "validationGenerale" 
document.getElementById("formModificationMdp").onsubmit = validationGenerale;
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
//la fonction validationGenerale() vérifie que les données saisies sont correctes
//elle retourne un résultat booléen :
//true valide le submit et permet la transmission des données du formulaire vers le serveur
//false bloque le submit et empêche la transmission des données du formulaire vers le serveur
function validationGenerale() {
if (document.getElementById("txtMdp").value == "") {
afficher_avertissement("L'ancien mot de passe doit être obligatoirement saisi !");
document.getElementById("txtMdp").focus(); // place le focus sur la zone à corriger
return false;
}
if (document.getElementById("txtNouveauMdp").value == "") {
afficher_avertissement("Le nouveau mot de passe doit être obligatoirement saisi !");
document.getElementById("txtNouveauMdp").focus(); // place le focus sur la zone à corriger
return false;
}
if (document.getElementById("txtConfirmationMdp").value == "") {
afficher_avertissement("La confirmation du nouveau mot de passe doit être obligatoirement saisie !");
document.getElementById("txtConfirmationMdp").focus(); // place le focus sur la zone à corriger
return false;
}
if ( estUnMdpCorrect(document.getElementById("txtNouveauMdp").value) == false) {
afficher_avertissement("Le mot de passe doit comporter au moins 8 caractères, dont au moins une lettre minuscule, une lettre majuscule et un chiffre !");
document.getElementById("txtNouveauMdp").focus(); // place le focus sur la zone à corriger
return false;
}
if (document.getElementById("txtNouveauMdp").value != document.getElementById("txtConfirmationMdp").value) {
afficher_avertissement("Les 2 valeurs saisies sont différentes !");
document.getElementById("txtNouveauMdp").focus(); // place le focus sur la zone à corriger
return false;
}
//si on arrive ici, c'est que toutes les données sont OK :
return true;
}
//la fonction estUnMdpCorrect vérifie que le mot de passe comporte au moins 8 caractères,
//dont au moins une lettre minuscule, une lettre majuscule et un chiffre
function estUnMdpCorrect(leMdpAtester) {
//utilisation d'une expression régulière pour vérifier la force du mot de passe :
EXPRESSION = "^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})";
monExprRegul = new RegExp(EXPRESSION);
//on retourne true si le leMdpAtester est bon et si le leMdpAtester comporte au moins 8 caractères :
if ( monExprRegul.test (leMdpAtester) == true && leMdpAtester.length >= 8 ) return true;
else return false;
}

</script>
</head>
<body>
	<div id="page">
		<h3>Modifier mon mot de passe</h3>
		<form id="formModificationMdp" name="formModificationMdp" method="post" action="index.php?action=ChangerDeMdp&login=<?php echo $login?>" >
			<p>
				<label for="txtMdp">Ancien mot de passe :</label>
				<input type="<?php if ($afficherMdp == 'off') echo 'password'; else echo 'text'; ?>" id="txtMdp" name="txtMdp" required value="<?php echo $mdp; ?>" />
			</p>
			<p>
				<label for="txtNouveauMdp">Nouveau mot de passe :</label>
				<input type="<?php if ($afficherMdp == 'off') echo 'password'; else echo 'text'; ?>" id="txtNouveauMdp" name="txtNouveauMdp" required value="<?php echo $nouveauMdp; ?>" />
			</p>
			
			<p>
				<label for="txtNouveauMdp">Confirmation :</label>
				<input type="<?php if ($afficherMdp == 'off') echo 'password'; else echo 'text'; ?>" id="txtConfirmationMdp" name="txtConfirmationMdp" required value="<?php echo $nouveauMdpConfirm; ?>" />
			</p>
			<p><input type="submit" id="btnEnvoyer" name="btnEnvoyer" value="Envoyer" />
			<p><a href="index.php?action=Connecter" class="bouton-menu">Retour à la page de connexion</a></p>
			<p id="message-erreur"><?php echo $message; ?></p>
			<p>
				<label for="caseAfficherMdp">Afficher en clair :</label>
				<input type="checkbox" name="caseAfficherMdp" id="caseAfficherMdp"
                <?php if ($afficherMdp == 'on') echo 'checked'; ?> >
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