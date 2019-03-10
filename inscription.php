<?php	
	require_once "membre.php";
	$mb = new membre();
	if($mb->comptearebours()=='end')
	{
		$activate = "btn btn-primary disabled";
		$actiate2 =  "form-control disabled";
		$_SESSION['error'] = "L'inscription est deja terminé dommage pour vous";
		echo $mb->comptearebours();
	}
	else{
		$activate = "btn btn-primary";
		$_SESSION['error'] = null;
		$actiate2 = "form-control";
	}

	if (isset($_SESSION['err'])) 
	{
		$nom = $_SESSION['nom'];
		$postnom = $_SESSION['postnom'];
		$prenom = $_SESSION['prenom'];
		$email = $_SESSION['email'];
		$date = $_SESSION['date'];
		$motivation = $_SESSION['motivation'];
		$tel =$_SESSION['tel'];
		$matr = $_SESSION['matr'];
		$prom = $_SESSION['prom'];
	}
	else
	{
		$nom = null;
		$postnom = null;
		$prenom = null;
		$email = null;
		$date = null;
		$motivation = null;
		$tel = null;
		$matr = null;
		$prom = null;
		$_SESSION['error1'] = null;
		$_SESSION['error2'] = null;
		$_SESSION['error3'] = null;
		$_SESSION['error4'] = null; 
		$_SESSION['error6'] = null;
		$_SESSION['error5'] = null;
		$_SESSION['error7'] = null;
		$_SESSION['error8'] = null;
		$_SESSION['error9'] = null;
		$_SESSION['error10'] = null;
	}
	$state1 = (!isset($_SESSION['error1']))?'form-group has-success has-feedback':'form-group has-error has-feedback';
	$state2 = (!isset($_SESSION['error2']))?'form-group has-success has-feedback':'form-group has-error has-feedback';
	$state3 = (!isset($_SESSION['error3']))?'form-group has-success has-feedback':'form-group has-error has-feedback';
	$state4 = (!isset($_SESSION['error4']))?'form-group has-success has-feedback':'form-group has-error has-feedback';
	$state5 = (!isset($_SESSION['error5']))?'form-group has-success has-feedback':'form-group has-error has-feedback';
	$state6 = (!isset($_SESSION['error6']))?'form-group has-success has-feedback':'form-group has-error has-feedback';
	$state7 = (!isset($_SESSION['error7']))?'form-group has-success has-feedback':'form-group has-error has-feedback';
	$state8 = (!isset($_SESSION['error8']))?'form-group has-success has-feedback':'form-group has-error has-feedback';
	$state9 = (!isset($_SESSION['error9']))?'form-group has-success has-feedback':'form-group has-error has-feedback';
	$state10 = (!isset($_SESSION['error10']))?'form-group has-success has-feedback':'form-group has-error has-feedback';

	$a = (isset($nom))?'glyphicon glyphicon-ok form-control-feedback':'glyphicon glyphicon-remove form-control-feedback';
	$b = (isset($postnom))?'glyphicon glyphicon-ok form-control-feedback':'glyphicon glyphicon-remove form-control-feedback';
	$c = (isset($prenom))?'glyphicon glyphicon-ok form-control-feedback':'glyphicon glyphicon-remove form-control-feedback';
	$d = (isset($email))?'glyphicon glyphicon-ok form-control-feedback':'glyphicon glyphicon-remove form-control-feedback';
	$e = (isset($date))?'glyphicon glyphicon-ok form-control-feedback':'glyphicon glyphicon-remove form-control-feedback';
	$f = (isset($motivation))?'glyphicon glyphicon-ok form-control-feedback':'glyphicon glyphicon-remove form-control-feedback';
	$g = (isset($tel))?'glyphicon glyphicon-ok form-control-feedback':'glyphicon glyphicon-remove form-control-feedback';
	$h = (isset($matr))?'glyphicon glyphicon-ok form-control-feedback':'glyphicon glyphicon-remove form-control-feedback';
	$i = (isset($prom))?'glyphicon glyphicon-ok form-control-feedback':'glyphicon glyphicon-remove form-control-feedback';

	$er = (isset($_SESSION['error']))?'alert alert-danger':'';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Inscription</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<script type="text/javascript" src="bootstrap/js/jquery-1.10.2.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="bootstrap/js/main.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<h1>Inscrivez vous</h1>
				<div class="<?=$er?>">
				<?=$_SESSION['error']?>
				</div>
				<form action="traitement.php" method="post" enctype="multipart/form-data">
					<div class="<?= $state1 ?>">
						<label>Nom</label>
						<input type="text" name="nom" class="<?=$actiate2?>" placeholder="Votre nom" id="idSucces" value="<?=$nom?>">
						<span class="<?=$a?>"></span>
						<span class="help-block"><?= $_SESSION['error1']?></span>
					</div>
					<div class="<?= $state2 ?>">
						<label>Postom</label>
						<input type="text" name="postnom" class="<?=$actiate2?>" placeholder="Votre postnom" value="<?=$postnom?>">
						<span class="<?=$b?>"></span>
						<span class="help-block"><?= $_SESSION['error2']?></span>
					</div>
					<div class="<?= $state3 ?>">
						<label>prenom</label>
						<input type="text" name="prenom" class="<?=$actiate2?>" placeholder="Votre prenom" value="<?=$prenom?>">
						<span class="<?=$c?>"></span>
						<span class="help-block"><?= $_SESSION['error3']?></span>
					</div>
					<div class="<?= $state9 ?>">
						<label>Matricule</label>
						<input type="text" name="matr" class="<?=$actiate2?>" placeholder="Votre matricule" value="<?=$matr?>">
						<span class="<?=$h?>"></span>
						<span class="help-block"><?= $_SESSION['error9']?></span>
					</div>
					<div class="<?= $state4 ?>">
						<label>Email</label>
						<input type="text" name="email" id="email" class="<?=$actiate2?>" placeholder="Votre email" value="<?=$email?>">
						<span class="<?=$d?>"></span>
						<span class="help-block"><?= $_SESSION['error4']?></span>
					</div>
					<div class="<?= $state7 ?>">
						<label>Telephone</label>
						<input type="text" name="tel" class="<?=$actiate2?>" placeholder="Votre numero de Telephone" value="<?=$tel?>">
						<span class="<?=$g?>"></span>
						<span class="help-block"><?= $_SESSION['error7']?></span>
					</div>
					<div class="<?= $state8 ?>">
						<label>Photo</label>
						<input type="file" name="photo" class="<?=$actiate2?>">
						<span class="help-block"><?= $_SESSION['error8']?></span>
					</div>
					<div class="<?= $state5 ?>">
						<label>Date de naissance</label>
						<input type="date" name="date" class="<?=$actiate2?>" placeholder="date de naissance" value="<?=$date?>">
						<span class="<?=$e?>"></span>
						<span class="help-block"><?= $_SESSION['error5']?></span>
					</div>
					<div class="<?= $state6 ?>">
						<label>Motivation</label>
						<textarea id="textarea" type="textarea" class="<?=$actiate2?>" name="motivation" placeholder="entrer la motivation" value=""><?=$motivation?></textarea>
						<span class="<?=$f?>"></span>
						<span class="help-block"><?= $_SESSION['error6']?></span>
					</div>
					<div class="<?= $state10 ?>">
						<label for="select">Select : </label>
						<select id="select" class="<?=$actiate2?>" name="promotion">
							<option value="PREPA">PREPARATOIRE</option>
					        <option value="G1">PREMIER GRADUAT</option>
					        <optgroup label="GENIE LOGICIEL">
					            <option value="G2SI">G2 SYSTEME INFO</option>
					            <option value="G2GEST">G2 GESTION</option>
					            <option value="G3SI">G3 SYSTEME INFO</option>
					            <option value="G3GEST">G3 GESTION</option>
					        </optgroup>
					        <optgroup label="DESIGN">
					            <option value="G2DSG">G2 DESIGN</option>
					            <option value="G3DSG">G3 DESIGN</option>
					        </optgroup>
					        <optgroup label="RESEAUX ET TELECOM">
					            <option value="G2RES">G2 RESEAUX</option>
					            <option value="G2TLC">G2 TELECOM</option>
					            <option value="G3RES">G3 RESEAUX</option>
					            <option value="G3TLC">G3 TELECOM</option>
					        </optgroup>
						</select>
						<span class="<?=$i?>"></span>
						<span class="help-block"><?= $_SESSION['error10']?></span>
					</div>
					<div class="form-group">
						<input type="submit" value="Enregistrer" class="<?=$activate?>">
					</div>
					
				</form>
				
			</div>
		</div>
	</div>
</body>
</html>
<script>
	$(document).ready(function(){
		$('#email').change(function(){
			var email = $('#email').val();
			if (email != '') {
				$.ajax({
					url:"traitement.php";
					method:"POST",
					data:{email:email},
					success:function(data){
						alert('ok');
					}
				});
			}
		});
	});
</script>