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
	<div class="container">
		<h1 class="success"><span class="glyphicon glyphicon-ok-sign"></span>Inscription terminé</h1>
		<button class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-user"></span></button>
		<?= $_SESSION['nom'].' '.$_SESSION['postnom'].' '.$_SESSION['prenom']?>
		<div class="row" style="margin-top: 3px">
			<div class="col-xs-12 col-sm-6 col-md-6">
				<div class="well well-sm">
						<div class="row">
						    <div class="col-sm-4 col-md-6 col-lg-7">
						        <img src="photo/<?=$_SESSION["avatar"]?>" alt="" class="img-rounded img-responsive" width="300px" height="200px" />
						    </div>
						    <div class="col-sm-8 col-md-6 col-lg-5">
						    <h4><?= $_SESSION['nom'].' '.$_SESSION['postnom'].' '.$_SESSION['prenom']?></h4>
						    <small><cite title="San Diego, USA">Dep Dem, Congo <i class="fa fa-map-marker"></i></cite></small>
						    <p>
						        <i class="glyphicon glyphicon-envelope"></i> <a href="mailto:<?= $_SESSION['email']?>"><?= $_SESSION['email']?></a>
						        <br />
						    	<i class="glyphicon glyphicon-gift"></i> Age : <?=$_SESSION['date']?> ans
						        <br />
						       	<i class="fa fa-phone"></i> <?=$_SESSION['tel']?><br>
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