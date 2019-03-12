<?php
	session_name("inscription");
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Inscription-Terminé</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/fonts/font-awesome.css">
</head>
<body>
	<style type="text/css">
		.btn-lg
		{
			width: 50px;
			height: 50px;
			border-radius: 25px;
		}
	</style>
	<?php
		$bd_nom_serveur='localhost';
		$bd_login='root';
		$bd_mot_de_passe='';
		$bd_nom_bd='ecologie';
		try
		{
				$connexion = new PDO("mysql:host=$bd_nom_serveur;dbname=$bd_nom_bd", $bd_login, $bd_mot_de_passe);
				$connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch (Exception $e)
		{
				die('Erreur : ' . $e->getMessage());
		}

		$donnees = $connexion->prepare('SELECT * FROM ecologie WHERE membre_id = :id');
		$donnees->bindValue(':id', $_SESSION['id']);
		$donnees->execute();
		$data = $donnees->fetch();
	?>
	<div class="container">
		<h1 class="success"><span class="glyphicon glyphicon-ok-sign"></span>Mon identité</h1>
		<button class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-user"></span></button>
		<?= $data['membre_nom'].' '.$data['membre_postnom'].' '.$data['membre_prenom']?>
		<div class="row" style="margin-top: 3px">
			<div class="col-xs-12 col-sm-6 col-md-6">
				<div class="well well-sm">
						<div class="row">
						    <div class="col-sm-4 col-md-6 col-lg-7">
						        <img src="photo/<?=$data["membre_pics"]?>" alt="" class="img-rounded img-responsive" width="300px" height="200px" />
						    </div>
						    <div class="col-sm-8 col-md-6 col-lg-5">
						    <h4><?= $data['membre_nom'].' '.$data['membre_postnom'].' '.$data['membre_prenom']?></h4>
						    <small><cite title="San Diego, USA">Dep Dem, Congo <i class="fa fa-map-marker"></i></cite></small>
						    <p>
						        <i class="glyphicon glyphicon-envelope"></i> <a href="mailto:<?= $data['membre_email']?>"><?= $data['membre_email']?></a>
						        <br />
						    	<i class="glyphicon glyphicon-gift"></i> Age : <?=$data['membre_age']?> ans
						        <br />
						       	<i class="fa fa-phone"></i> <?=$data['membre_tel']?><br>
						        <i class="fa fa-gear"></i> <a href=""> Modifier profil</a>
						    </p>
						    <div class="btn-group">
						        <a href="https://facebook.com/bashamalex" class="btn btn-primary"><span class="fa fa-2x fa-facebook"></span></a>
						        <a href="mailto:fidelepl@gmail.com" class="btn btn-danger"><span class="fa fa-2x fa-google"></span></a>
						         <a href="@fideleplk" class="btn btn-primary""><span class="fa fa-2x fa-twitter"></span></a>
						    </div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<button class="btn btn-success btn-lg"><a href="liste_membre.php"><i class="fa fa-table"></i></a></button> Voir tous les membres
		<button class="btn btn-warning btn-lg"><a href="terminer.php"><i class="fa fa-sign-out"></i></a></button> Se deconnecter
	</div>

</body>
</html>
