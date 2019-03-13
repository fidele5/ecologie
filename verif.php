<?php
  require_once "membre.php";
  $mb = new membre();

  $matr = $_POST['matricule'];

  $_SESSION['error1'] = null;
  $_SESSION['error2'] = null;
  $i = 0;

  if(empty($matr))
  {
      $_SESSION['error1'] = "<em>Vous devez renseigner un mot de passe</em>";
      $i++;
  }
  
  if ($mb->connexion($matr) == "error") {
    $_SESSION['error1'] = "Connexion echoué verifier votre matricule";
    $i++;
  }
  
  if ($i>0) 
  {
    $_SESSION['err'] = $i;
    header('location: connexion.php');
  }
  else 
  {
    header('location: page.php');
  }
 ?>
