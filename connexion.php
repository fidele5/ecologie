<?php
  require_once "membre.php";
  $mb = new membre();

  if (isset($_SESSION['error1']))
	{
		$matr = $_SESSION['error1'];
	}
	else
	{
		$matr = null;
		$_SESSION['error1'] = null;
	}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
  	<script type="text/javascript" src="bootstrap/js/jquery-1.10.2.min.js"></script>
  	<script src="bootstrap/js/bootstrap.min.js"></script>
  	<script src="bootstrap/js/main.js"></script>
    <?php
    $state1 = (!isset($_SESSION['error1']))?'form-group has-success has-feedback':
              'form-group has-error has-feedback';
    $i = (isset($matr))?'glyphicon glyphicon-ok form-control-feedback':
              'glyphicon glyphicon-remove form-control-feedback';
    ?>
  </head>
  <body>
        <div class="row">
          <div class="col-md-4">
            <h1>connectez-vous</h1>
            <form action="verif.php" method="post">
                <div class="<?=$state1?>">
                  <label>Matricule</label>
                  <input type="text" name="matricule" class="form-control" placeholder="Votre nom" id="idSucces" >
                  <span class="<?=$i?>"></span>
                  <span class="help-block"><?=$_SESSION["error1"]?></span>
                </div>
                <div class="form-group">
                  <input type="submit" value="Se connecter" class="btn btn-primary">
                </div>
            </form>
          </div>
        </div>
  </body>
</html>
