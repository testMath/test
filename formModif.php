<?php
session_start();

include "include/register.php";

//message de retour suite à l'ajout d'un client
$messageClient = isset($_SESSION['messageClient']) ? $_SESSION['messageClient'] : "";
unset($_SESSION['messageClient']);

//message de retour suite à l'ajout d'une habitation
$messageHabitation = isset($_SESSION['messageHabitation']) ? $_SESSION['messageHabitation'] : "";
unset($_SESSION['messageHabitation']);

//message de retour suite à l'ajout d'une location
$messageLocation = isset($_SESSION['messageLocation']) ? $_SESSION['messageLocation'] : "";
unset($_SESSION['messageLocation']);

//récupération des champs de saisies CLIENT
$optionNom = "" ;
$nomsClient = new ClientManager;
$tableauNomsClients = $nomsClient->recupererNomClient();

//Recupération du choix du client
$choixClient = "";
if (isset($_SESSION['infoClient']))
{
	$infoClient = $_SESSION['infoClient'];
	$choixClient = "Client sélectionné :<br/>Nom : " . $infoClient[0] . "<br/>";
}

//affichage des nom des clients existants 
$nom ="";
$villeResid = "";
$profession = "";
foreach ($tableauNomsClients as $tuple) 
{
	//selectionner le nom du client précedement selectionné
	if (isset($infoClient[0]) && $tuple[0] == $infoClient[0])
	{
		$optionNom .= "<option value=\"" . $tuple[0] . "\" selected>" . $tuple[0] ."</option>";
	}
	else
	{
		//recuperer tous les autres noms clients
		$optionNom .= "<option value=\"" . $tuple[0] . "\">" . $tuple[0] ."</option>";
	}
}

//récupération des champs de saisies HABITATION
$optionCodeh = "";
$codeH = new HabitationManager;
$tableauCodeH = $codeH->recupererCodeH();

//Recupération du CODEH
if (isset($_SESSION['infoCodeh']))
{
	$infoCodeh = $_SESSION['infoCodeh'];
	$selectType = $infoCodeh[1];
	$choixCodeh = "Sélection du code d'une habitation : " . $infoCodeh[0] . "<br/>";
}

//affichage des nom des CODEH existants 
foreach ($tableauCodeH as $tuple) 
{
	//selectionner le CODEH précedement selectionné
	if (isset($infoCodeh[0]) && $tuple[0] == $infoCodeh[0])
	{
		$optionCodeh .= "<option value=\"" . $tuple[0] . "\" selected>" . $tuple[0] ."</option>";
	}
	else
	{
		//recuperer tous les autres CODEH
		$optionCodeh .= "<option value=\"" . $tuple[0] . "\">" . $tuple[0] ."</option>";
	}
}

//récupération des champs de saisies LOCATION
$optionCodel = "";
$codeL = new LocationManager;
$tableauCodeL = $codeL->recupererCodeL();

//Recupération du CODEH
if (isset($_SESSION['infoCodel']))
{
	$infoCodel = $_SESSION['infoCodel'];
	$choixCodel = "Sélection code des habitations loués : " . $infoCodel[0] . "<br/>";
}

//affichage des nom des CODEH existants 
foreach ($tableauCodeL as $tuple) 
{
	//selectionner le CODEH précedement selectionné
	if (isset($infoCodel[0]) && $tuple[0] == $infoCodel[0])
	{
		$infoCodel .= "<option value=\"" . $tuple[0] . "\" selected>" . $tuple[0] ."</option>";
	}
	else
	{
		//recuperer tous les autres CODEH
		$optionCodel .= "<option value=\"" . $tuple[0] . "\">" . $tuple[0] ."</option>";
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Modifier Supprimer</title>
		<h1>Modifier et supprimer</h1>
		<a href="formAjout.php">Aller au formulaire d'ajout</a>
		<form action="traitementModif.php" method="POST">
			<h2>Client</h2>
			<?php echo $choixClient; ?>
			Nom
			<select name ="nom">
				<?php echo $optionNom; ?>
			</select><input type="submit" name="afficherClient" value="afficher"><br/>
			Ville de Résidence
			<input type="text" name="villeResid" placeholder="<?php echo empty($infoClient[1]) ? "" : $infoClient[1]; ?>"><br/>
			Profession
			<input type="text" name="profession" placeholder="<?php echo empty($infoClient[2]) ? "" : $infoClient[2]; ?>"><br/>
			<?php echo $messageClient; ?>
			<input type="submit" name="modifierClient" value="Modifier">
			<input type="submit" name="supprimerClient" value="Supprimer">
		</form>

		<form action="traitementModif.php" method="POST">
			<h2>Habitation</h2>
			Code de l'habitation
			<select name ="codeh">
				<?php echo $optionCodeh; ?>
			</select><input type="submit" name="afficherHabitation" value="afficher"><br/>
			Type de l'habitation
			<select name="typeh">
				<option value="TYPE1" <?php echo $selectType = "TYPE1"? "selected" : ""; ?> >Type 1</option>
				<option value="TYPE2" <?php echo $selectType = "TYPE2"? "selected" : ""; ?> >Type 2</option>
				<option value="TYPE3" <?php echo $selectType = "TYPE3"? "selected" : ""; ?> >Type 3</option>
				<option value="TYPE4" <?php echo $selectType = "TYPE4"? "selected" : ""; ?> >Type 4</option>
				<option value="TYPE5" <?php echo $selectType = "TYPE5"? "selected" : ""; ?> >Type 5</option>
				<option value="VILLA" <?php echo $selectType = "VILLA"? "selected" : ""; ?> >Villa</option>
			</select><br/>
			Adresse
			<input type="text" name="adresse"  placeholder="<?php echo empty($infoCodeh[2]) ? "" : $infoCodeh[2]; ?>"><br/>
			Ville
			<input type="text" name="ville" placeholder="<?php echo empty($infoCodeh[3]) ? "" : $infoCodeh[3]; ?>"><br/>
			Loyer Mensuel
			<input type="text" name="loyerM" placeholder="<?php echo empty($infoCodeh[4]) ? "" : $infoCodeh[4]; ?>"><br/>
			<?php echo $messageHabitation; ?>
			<input type="submit" name="modifierHabitation" value="Modifier">
			<input type="submit" name="supprimerHabitation" value="Supprimer">
		</form>

		<form action="traitementModif.php" method="POST">
			<h2>Location</h2>
			Code de l'habitation
			<select name ="codel">
				<?php echo $optionCodel; ?>
			</select><input type="submit" name="afficherLocation" value="afficher"><br/>
			Nom du Client
			<input type="text" name="nom"><br/>
			Nombre de mois loué
			<input type="text" name="nombMois"><br/>
			<?php echo $messageLocation; ?>
			<input type="submit" name="modifierLocation" value="Modifier">
			<input type="submit" name="supprimerLocation" value="Supprimer">
		</form>
	</head>
	<body>

	</body>
</html>