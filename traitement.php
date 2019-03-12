<?php
	require_once "membre.php";

	$nom = htmlspecialchars($_POST['nom']);
	$postnom = htmlspecialchars($_POST['postnom']);
	$prenom = htmlspecialchars($_POST['prenom']);
	$email = htmlspecialchars($_POST['email']);
	$date = htmlspecialchars($_POST["date"]);
	$motivation = htmlspecialchars($_POST['motivation']);
	$tel = htmlspecialchars($_POST['tel']);
	$avatar = $_FILES['photo']['name'];
	$matr = htmlspecialchars($_POST['matr']);
	$prom = htmlspecialchars($_POST['promotion']);
	$_SESSION['error'] = null;
	$_SESSION['error1'] = null;
	$_SESSION['error2'] = null;
	$_SESSION['error3'] = null;
	$_SESSION['error4'] = null;
	$_SESSION['error5'] = null;
	$_SESSION['error6'] = null;
	$_SESSION['error7'] = null;
	$_SESSION['error8'] = null;
	$_SESSION['error9'] = null;
	$_SESSION['error10'] = null;
	$_SESSION['nom'] = null;
	$_SESSION['postnom'] = null;
	$_SESSION['prenom'] = null;
	$_SESSION['email'] = null;
	$_SESSION['date'] = null;
	$_SESSION['motivation'] = null;
	$_SESSION['matr'] = null;
	$_SESSION['prom'] = null;
	$_SESSION['tel'] = null;
	$i = 0;
	$control = new membre();
	// verification du pseudo
	if ($control->checkNom($nom) == "vide"){$_SESSION['error1'] = "vous n'avez pas entré de nom<br>"; $i++;}
	elseif ($control->checkNom($nom) == "court"){$_SESSION['error1'] = "votre nom ne doit pas avoir moins de 4 caracteres<br>"; $i++;}
	elseif ($control->checkNom($nom) == "long"){$_SESSION['error1'] = "votre nom ne doit pas avoir plus de 64 caracteres<br>"; $i++;}
	else $_SESSION['nom'] = $control->nom;

	//verification du mpd
	if ($control->checkPost($postnom) == "vide"){$_SESSION['error2'] = "vous n'avez pas entré de postnom<br>"; $i++;}
	elseif ($control->checkPost($postnom) == "court"){$_SESSION['error2'] = "votre postnom ne doit pas avoir moins de 4 caracteres<br>"; $i++;}
	elseif ($control->checkPost($postnom) == "long"){$_SESSION['error2'] = "votre postnom ne doit pas avoir plus de 64 caracteres<br>"; $i++;}
	else $_SESSION['postnom'] = $control->postnom;

	//verification de l'email
	if ($control->checkPre($prenom) == "vide"){$_SESSION['error3'] = "vous n'avez pas entré de prenom<br>"; $i++;}
	elseif ($control->checkPre($prenom) == "court"){$_SESSION['error3'] = "votre prenom ne doit pas avoir moins de 4 caracteres<br>"; $i++;}
	elseif ($control->checkPre($prenom) == "long"){$_SESSION['error3'] = "votre prenom ne doit pas avoir plus de 64 caracteres<br>"; $i++;}
	else $_SESSION['prenom'] = $control->prenom;

	// verification du matricule
	if ($control->checkmatr($matr) == "emptymat"){$_SESSION['error9'] = "<em>Vous devez renseigner le matricule</em><br>"; $i++;}
	elseif ($control->checkmatr($matr) == "incorrect") {$_SESSION['error9'] = "<em>matricule incorrect</em><br>"; $i++;}
	elseif ($control->checkmatr($matr) == "exists"){$_SESSION['error9'] = "<em>Le matricule que vous voulez utiliser appartient à quelqu'un d'autre</em><br>"; $i++;}
	else
		$_SESSION['matr'] = $control->matr;

	// verification de la promotion
	if ($control->checkprom($prom) == "emptyprom"){$_SESSION['error10'] = "<em>Vous devez renseigner la promotion</em><br>"; $i++;}
	elseif ($control->checkprom($prom) == "invalid") {$_SESSION['error10'] = "<em>Vous n'etes pas de cette promotion</em><br>"; $i++;}
	elseif($control->Verifin($prom) == "full"){$_SESSION['error10'] = "<em>Vous ne puvez pas vous inscrire car le nombre total par promotion est deja atteint</em><br>"; $i++;}
	else $_SESSION['prom'] = $control->prom;

	//verification de l'email
	if ($control->checkmail($email) == "vide" ){$_SESSION['error4'] = "Vous n'avez pas entré de mail<br>"; $i++;}
	elseif($control->checkmail($email) == "isnt"){$_SESSION['error4'] = "Le mail que vous avez entré n'a pas un format valide<br>"; $i++;}
	elseif($control->checkmail($email) == "exists"){$_SESSION['error4'] = "Le mail que vous voulez utiliser existe cherchez en un autre<br>";$i++;}
	elseif($control->checkmail($email) == "mamaee"){$_SESSION['error4'] = "C'est n'importe quoi ce email! il existe vraiment?!<br>";$i++;}
	else $_SESSION['email'] = $control->email;

	// verification de la date de naissance
	if($control->verifdate($date) == 'vide'){$_SESSION['error5']  = "Vous n'avez pas spécifié votre date de naissance<br>"; $i++;}
	elseif($control->verifdate($date) == 'young'){$_SESSION['error5']  = "Non non non Vous etes trop jeune pour l'université!<br>"; $i++;}
	elseif($control->verifdate($date) == 'old'){$_SESSION['error5']  = "Non non non Vous etes trop vieux pour l'université vous devriez aller a la retraite!<br>"; $i++;}
	else $_SESSION['date'] = $control->date;

	// verification de la motivation
	if ($control->motiv($motivation)=='empty') {$_SESSION['error6'] = "Votre motivation doit avoir plus de 15 caracteres<br>"; $i++;}
	elseif ($control->motiv($motivation)=='short') {$_SESSION['error6'] = "Votre motivation doit avoir plus de 15 caracteres<br>"; $i++;}
	else $_SESSION['motivation'] = $control->motivation;

	// verification de la photo
	if($control->avatar($avatar) == 'long'){$_SESSION['error8'] = "le fichier depasse la limite autorisée sur le serveur<br>"; $i++;}
	elseif($control->avatar($avatar) == 'grand'){$_SESSION['error8'] = "Le fichier dépasse la limite autorisée dans le formulaire HTML !<br>"; $i++;}
	elseif($control->avatar($avatar) == 'echec'){$_SESSION['error8'] = "L'envoi du fichier a été interrompu pendant le transfert !<br>"; $i++;}
	elseif($control->avatar($avatar) == 'vide'){$_SESSION['error8'] = "Le fichier que vous avez envoyé a une taille nulle !<br>"; $i++;}
	else $_SESSION['avatar'] = $control->avatar;

	// verification du numero de telephone
	if ($control->checktel($tel) == "empty"){$_SESSION['error7'] = "votre numero de telephone est incorrect<br>"; $i++;}
	elseif ($control->checktel($tel) == "short"){$_SESSION['error7'] = "votre numero de telephone ne doit pas avoir moins de 4 caracteres<br>"; $i++;}
	elseif ($control->checktel($tel) == "long"){$_SESSION['error7'] = "votre numero de telephone ne doit pas avoir plus de 64 caracteres<br>"; $i++;}
	else $_SESSION['tel'] = $control->tel;

	if ($i>0) {
		$_SESSION['err'] = $i;
		header("location: inscription.php");
	}
	else
	{
		$control->inserer();
		header('location: connexion.php');
	}


	foreach ($_SESSION as $key => $value) {
		echo $key.' : '.$value.'<br>';
	}

	echo "=================== Post ====================================<br>";
	foreach ($_POST as $cle => $valeur) {
		echo $cle.' : '.$valeur.'<br>';
	}

	foreach ($_SESSION as $key => $value) {
		echo $key.' : '.$value.'<br>';
	}

	echo "=================== Post ====================================<br>";
	foreach ($_POST as $cle => $valeur) {
		echo $cle.' : '.$valeur.'<br>';
	}

	echo $control->Verifin($prom);
?>
