<?php
    function checkmatr($mat)
    {
        if (empty($mat)) return "emptymat";
        else
        {
            try 
            {
                $connexion = new PDO("mysql:host=localhost;dbname=ecologie", "root", "", null);
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
                else return $mat;
                 
            } 
            else return "incorrect";
        }
    }
    echo checkmatr('16BN016')."<br>";

    function checkprom($prom, $matr)
        {
            if (empty($prom)) return "emptyprom";
            else
            {
                try 
                {
                    $connexion = new PDO("mysql:host=localhost;dbname=ecologie", "root", "", null);
                    $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } 
                catch (Exception $e) 
                {
                    die('Erreur : ' . $e->getMessage());
                }
                $res=$connexion->prepare('SELECT COUNT(*) AS nbr2 FROM etudiants WHERE promotion = :prom AND matricule = :matr');
                $res->bindValue(':prom',$prom, PDO::PARAM_STR);
                $res->bindValue(':matr',$matr, PDO::PARAM_STR);
                $res->execute();
                $email_free=($res->fetchColumn()==0)?1:0;
                $res->CloseCursor();
                if (!$email_free) return $prom;
                else return "invalid";
            }
        }

        echo checkprom('G2GEST','16PK390');
?>