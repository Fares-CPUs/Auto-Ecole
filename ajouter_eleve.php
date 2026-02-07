<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ajouter un élève</title>
        <link rel="stylesheet" href="style.css" type="text/css">
    </head>
    <body>
        <h1 class="form-title">Ajouter un éleve</h1>
        <?php

                date_default_timezone_set('Europe/Paris');
                $date = date("Y-m-d");
                //connexion à la base
                $dbhost = 'tuxa.sme.utc';
                $dbuser = 'nf92a007';

                $dbpass = '03ztVCZs8gJg';

                $dbname = 'nf92a007';

                $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');

                mysqli_set_charset($connect, 'utf8'); 


                if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['Ndate']) ) {

                    echo "<div class='alert error'>   Erreur 404: Un champ est vide </div>";
                    exit();

                }

                // cette fonction permet l'utilisation des caractères spéciaux
                $nom = mysqli_real_escape_string($connect, $_POST['nom']);
                $prenom = mysqli_real_escape_string($connect, $_POST['prenom']);
                $dateN = mysqli_real_escape_string($connect, $_POST['Ndate']);

                
                


                //vérifie si un élève avec le même nom et prénom est enregistré
                $check = "SELECT nom, prenom FROM eleves WHERE nom = '$nom' AND prenom = '$prenom'";
                $result1= mysqli_query($connect, $check);
                

                if (!$result1){
                    echo "<div class='alert error'> 
                    <p>La requête n'a pas pu aboutir</p>
                    <div>";
                    exit();
                }

                if (mysqli_num_rows($result1) > 0)  {
                    // si l'élève existe déjà, génère une table qui récapitule les informations et demande si il veut vraiment rajouter cet élève

                    echo "<p><b>Attention: L'élève existe déjà, le rajouter quand même ?</b></p>";
                    echo "<ul>
                            <li> le nom saisie est : $nom $prenom</li>
                            <li> la date saisie est : $dateN</li>
                        </ul>
                        <form action = 'valider_eleve.php' method = 'post'>
                            <input name='nom' type='hidden' value='$nom'>
                            <input name='prenom' type='hidden' value='$prenom'>
                            <input name='Ndate' type='hidden' value='$dateN'>
                            <input type='submit' value='Valider'>
                            <input type='button' onclick=\"window.location='ajout_eleve.html'\"  value='Non' >
                        </form>";
                }
                else if ($dateN > $date){
                
                    // la date de naissance est deans le futur
                    echo "<p>Vous avez saisi une date de naissance dans le futur.</p>";
                    echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
                    echo "<input type='button' onclick=\"window.location='ajout_eleve.html'\" value='AJouter un élève' />";
                    exit;
                    
                }
                else{ // si tout est bon on insère
                    $query = "insert into eleves values (NULL,'$nom','$prenom','$dateN','$date')";
                    $result = mysqli_query($connect, $query);

                    if (!$result)
                    {
                        echo "<div class='alert error'> 
                                <p>La requête n'a pas pu aboutir</p>
                            <div>";
                        exit();
                    }
                    else{
                        echo"<div class='alert success'>   
                                <p> le nom saisie est : $nom $prenom </p>
                                <p>la date saisie est : $dateN </p>
                                <p>Elève ajouté avec succès.</p>
                            </div>";
                }
                }



                mysqli_close($connect);

        ?>

    </body>
</html>