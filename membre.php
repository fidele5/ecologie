<?php
session_name("inscription");
session_start();
class membre
{
	public $nom, $postnom, $prenom, $date, $motivation, $email, $avatar, $tel, $prom, $matr;
	private $bd_nom_serveur, $bd_login, $bd_mot_de_passe,$bd_nom_bd;

	public function __construct()
	{
		$this->nom = "";
		$this->postnom = "";
		$this->prenom = "";
		$this->email = "";
		$this->motivation = "";
		$this->date = "";
		$this->tel = "";
		$this->prom = "";
		$this->matr = "";
		$this->avatar = null;
		$this->bd_nom_serveur = 'localhost';
		$this->bd_login = 'root';
		$this->bd_mot_de_passe = '';
		$this->bd_nom_bd = 'ecologie';
	}

		// verification du pseudo
	public function checkNom($nom)
	{
		if (empty($nom)) return "vide";
		elseif (strlen($nom) < 4 ) return "court";
		elseif (strlen($nom) > 64) return "long";

		else
		{
			$this->nom = $nom;

		}
	}

	// verification du postnom
	public function checkPost($postnom)
	{
		if (empty($postnom)) return "vide";
		elseif (strlen($postnom) < 4 ) return "court";
		elseif (strlen($postnom) > 64) return "long";

		else
		{
			$this->postnom = $postnom;

		}
	}

	// verification du prenom
	public function checkPre($prenom)
	{
		if (empty($prenom)) return "vide";
		elseif (strlen($prenom) < 4 ) return "court";
		elseif (strlen($prenom) > 64) return "long";

		else
		{
			$this->prenom = $prenom;

		}
	}

	// verification de l'email
	public function checkmail($email)
	{
		$domaine = strstr($email, '@');
		if (empty($email)) return "vide";
		elseif (!preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#is', $email)) return 'isnt';
		//elseif(!checkdnsrr($domaine, 'MX')) return 'mamaee';
		else
		{
			try 
			{
				$connexion = new PDO("mysql:host=".$this->bd_nom_serveur.";dbname=".$this->bd_nom_bd."", $this->bd_login, $this->bd_mot_de_passe, null);
			    $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} 
			catch (Exception $e) 
			{
				die('Erreur : ' . $e->getMessage());
			}
			$result=$connexion->prepare('SELECT COUNT(*) AS nbr FROM ecologie WHERE membre_email = :email');
			$result->bindValue(':email',$email, PDO::PARAM_STR);
			$result->execute();
			$email_free=($result->fetchColumn()==0)?1:0;
			$result->CloseCursor();
			if (!$email_free) return "exists";
			else $this->email = $email;
		}
	}
	// verification de la date et calcul de l'age
	public function verifdate($date)
	{
		if (empty($date)) return "vide";
		else 
		{
			$annee = strtotime($date);
			$an = date('Y', $annee);
			$date = date('Y')-$an;
			if ($date < 17) return "young";
			elseif($date >= 50) return "old";
			else $this->date = $date;
		}
	}

	// envoyer un mail
	public function SendMail($email)
    {
        $message= "<html>
            <title>Confirmation</title>
            <body>
                Chers ".$this->prenom.",<br>
                    Vous etes desormais inscrit dans le club d'écologie<br>
                <button style='background-color : royalblue; border-radius : 5px; padding : 5px; border-color : pink; border : 1px; color : white;'><a href='http://google.com'>modifier les données</a></button><br>
                Nous vous remercions pour votre confiance<br>.
                © Aumonerie Esis ".date('Y')." - FidelePlk.</body></html>";
        $sujet = "Confirmation";
        $header = "From: \"Aumonerie ESIS\"<fideleplk@gmail.com>" . "\r\n";
        $header.= "Reply-to: \"Aumonerie ESIS\" <fideleplk@gmail.com>" . "\r\n";
        $header.= "MIME-Version: 1.0" . "\r\n";
        $header .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
        $header.= 'Cc: "Contact" <fideleplk@gmail.com>' . "\r\n";
        $header.= 'Bcc: "Contact" <fideleplk@yahoo.com>' . "\r\n";
        $sent = mail($email,$sujet,$message,$header);
        if ($sent) 
        {
            return true;
        }
	}
	
	public function checkmatr($mat)
        {
            if (empty($mat)) return "emptymat";
            else
            {
                try 
                {
                    $connexion = new PDO("mysql:host=".$this->bd_nom_serveur.";dbname=".$this->bd_nom_bd."", $this->bd_login, $this->bd_mot_de_passe, null);
                    $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } 
                catch (Exception $e) 
                {
                    die('Erreur : ' . $e->getMessage());
                }
                $result=$connexion->prepare('SELECT COUNT(*) AS nbr FROM etudiants WHERE matricule = :matr');
                $result->bindValue(':matr',$mat, PDO::PARAM_STR);
                $result->execute();
                $email_free=($result->fetchColumn()==0)?1:0;
                $result->CloseCursor();
                if (!$email_free){
					$resultat=$connexion->prepare('SELECT COUNT(*) AS nbr FROM ecologie WHERE membre_matricule = :matr');
					$resultat->bindValue(':matr',$mat, PDO::PARAM_STR);
					$resultat->execute();
					$matricule =($resultat->fetchColumn()==0)?1:0;
					if(!$matricule) return "exists"; 
					else $this->matr = $mat;
					 
				} 
                else return "incorrect";
            }
        }

		public function checkprom($prom)
        {
            if (empty($prom)) return "emptyprom";
            else
            {
                try 
                {
                    $connexion = new PDO("mysql:host=".$this->bd_nom_serveur.";dbname=".$this->bd_nom_bd."", $this->bd_login, $this->bd_mot_de_passe, null);
                    $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } 
                catch (Exception $e) 
                {
                    die('Erreur : ' . $e->getMessage());
                }
                $res=$connexion->prepare('SELECT COUNT(*) AS nbr2 FROM etudiants WHERE promotion = :prom AND matricule = :matr');
                $res->bindValue(':prom',$prom, PDO::PARAM_STR);
                $res->bindValue(':matr',$this->matr, PDO::PARAM_STR);
                $res->execute();
                $email_free=($res->fetchColumn()==0)?1:0;
                $res->CloseCursor();
                if (!$email_free) $this->prom = $prom;
                else return "invalid";
            }
        }

    public function avatar($avatar)
	{
			foreach($_FILES as $file)
			{
			    $extensions_valides = array('jpg' , 'jpeg' , 'gif' , 'png');
			    $text = substr(strrchr($file['name'], '.'), 1);
			    if (in_array($text, $extensions_valides)) {
			         $tmp_name = $file['tmp_name'];
			         $file['name']= explode(".", $file['name']);
			         $file['name']= $file['name'][0].".".$text;
			         $destination = 'photo/'.$file['name'];
			         move_uploaded_file($tmp_name,$destination);
			    }
			    if($file['error'] == UPLOAD_ERR_OK)
			    {
			    	$this->avatar = $file['name'];
			    }
			    else
			    {
			        switch ($file['error'])
			        {    
			                case 1: // UPLOAD_ERR_INI_SIZE    
			                return "long";    
			                break;    
			                case 2: // UPLOAD_ERR_FORM_SIZE    
			                return "grand";
			                break;    
			                case 3: // UPLOAD_ERR_PARTIAL    
			                return "echec";    
			                break;    
			                case 4: // UPLOAD_ERR_NO_FILE    
			                return "vide";
			                break;    
			        }    
			    }    
			}
		}

	// verification de la motivation
	public function motiv($motivation)
	{
		if (empty($motivation)) return 'empty';
		elseif (strlen($motivation)<=15) return 'short';
		else $this->motivation = $motivation;
	}

	// verification du numero de telephone

	public function checktel($tel)
	{
		if (empty($tel)) return 'empty';
		elseif (strlen($tel)<=4) return 'short';
		elseif (strlen($tel) > 64) return "long";
		else $this->tel = $tel;
	}

	// insertion dans la base des données
	public function inserer()
	{
		try 
		{
			$connexion = new PDO("mysql:host=".$this->bd_nom_serveur.";dbname=".$this->bd_nom_bd."", $this->bd_login, $this->bd_mot_de_passe, null);
			$connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} 
		catch (Exception $e) 
		{
			die('Erreur : ' . $e->getMessage());
		}
		$insert = $connexion->prepare('INSERT INTO ecologie(membre_nom, membre_postnom, membre_prenom, membre_matricule, membre_email, membre_tel, membre_pics, membre_promotion, membre_age, motivation) VALUES(:nom, :post, :pre, :matr, :email, :tel, :pics, :prom, :dat, :motiv)');
		$insert->bindValue(':nom', $this->nom);
		$insert->bindValue(':post', $this->postnom);
		$insert->bindValue(':pre', $this->prenom);
		$insert->bindValue(':matr', $this->matr);
		$insert->bindValue(':email', $this->email);
		$insert->bindValue(':tel', $this->tel);
		$insert->bindValue(':pics', $this->avatar);
		$insert->bindValue(':prom',$this->prom);
		$insert->bindValue(':dat', $this->date);
		$insert->bindValue(':motiv',$this->motivation);
		$i = $insert->execute();
		if ($i) $this->SendMail($this->email);
		else return "error";
		$insert->CloseCursor();
	}

	public function getAllmembers()
	{
		try 
		{
			$connexion = new PDO("mysql:host=".$this->bd_nom_serveur.";dbname=".$this->bd_nom_bd."", $this->bd_login, $this->bd_mot_de_passe, null);
			$connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} 
		catch (Exception $e) 
		{
			die('Erreur : ' . $e->getMessage());
		}
		$get = $connexion->prepare("SELECT * FROM ecologie");
		$get->execute();
		while ($data  = $get->fetch()) {
			echo "<tr>";
			echo "<td>".$data['membre_nom']."</td>";
			echo "<td>".$data['membre_postnom']."</td>";
			echo "<td>".$data['membre_prenom']."</td>";
			echo "<td>".$data['membre_email']."</td>";
			echo "<td>".$data['membre_promotion']."</td>";
			echo "</tr>";
		}
	}

	public function getall($prom)
	{
		try 
		{
			$connexion = new PDO("mysql:host=".$this->bd_nom_serveur.";dbname=".$this->bd_nom_bd."", $this->bd_login, $this->bd_mot_de_passe, null);
			$connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} 
		catch (Exception $e) 
		{
			die('Erreur : ' . $e->getMessage());
		}

		$result = $connexion->prepare("SELECT COUNT(*) FROM etudiants WHERE promotion = :prom");
		$result->bindValue(':prom', $prom, PDO::PARAM_STR);
		$result->execute();
		$aff2 = $result->fetchColumn();
		return $aff2;
	}

	public function Verifin($prom)
	{
		try 
		{
			$connexion = new PDO("mysql:host=".$this->bd_nom_serveur.";dbname=".$this->bd_nom_bd."", $this->bd_login, $this->bd_mot_de_passe, null);
			$connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} 
		catch (Exception $e) 
		{
			die('Erreur : ' . $e->getMessage());
		}

		$result = $connexion->prepare("SELECT COUNT(*) FROM ecologie WHERE membre_promotion = :prom");
		$result->bindValue(':prom', $prom, PDO::PARAM_STR);
		$result->execute();
		$aff = $result->fetchColumn();
		$pourc = ($aff/$this->getall($prom))*100; 
		if($pourc > 20){
			return 'full';
		}
	}

	public function connexion($matr)
	{
		try 
		{
			$connexion = new PDO("mysql:host=".$this->bd_nom_serveur.";dbname=".$this->bd_nom_bd."", $this->bd_login, $this->bd_mot_de_passe, null);
			$connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} 
		catch (Exception $e) 
		{
			die('Erreur : ' . $e->getMessage());
		}

		$connect = $connexion->prepare('SELECT * FROM ecologie WHERE membre_matricule = :matr');
		$connect->bindValue(':matr',$matr, PDO::PARAM_STR);
		$connect->execute();
		$val = $connect->fetch();

		if ($val['membre_matricule'] = $matr) 
		{
			$_SESSION['pseudo'] = $val['membre_prenom'];
			$_SESSION['id'] = $val['membre_id'];
		}
		else
			return "error";
		
	}
}

?>