<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ajouter un élève</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>
    <h1 class="form-title">Ajouter un thème</h1>
    <?php

date_default_timezone_set('Europe/Paris');

//connexion à la base
$date = date("Y-m-d");
$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a007';
$dbpass = '03ztVCZs8gJg';

$dbname = 'nf92a007';

$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');

mysqli_set_charset($connect, 'utf8'); 



// verification si les champs sont vides
if (empty($_POST['nom']) || empty($_POST['descriptif']) ) {
      echo "<div class='alert error'>  
                <p> Erreur 404: Un champ est vide </p>
            </div>";
                exit();
}

 // cette fonction permet l'utilisation des caractères spéciaux
$nom = mysqli_real_escape_string($connect, $_POST['nom']); // a condition que 'nom' soit le bon 'name'! expliquez.
$descriptif = mysqli_real_escape_string($connect, $_POST['descriptif']);


// requete SQL pour verifier si un theme desactivé existe dèja
$sql_check = "
    SELECT idtheme , supprime
    FROM themes 
    WHERE nom = '$nom'
    AND descriptif = '$descriptif'

";

$result_check = mysqli_query($connect, $sql_check);

if (mysqli_num_rows($result_check) > 0) {
    // si le thème existe on verifie s'il est supprime

    $row = mysqli_fetch_array($result_check);
    $id = $row['idtheme'];

if ($row['supprime'] == 1) {
        // réactiver
        $misajour= "UPDATE themes SET supprime = 0 WHERE idtheme = $id";
        mysqli_query($connect, $misajour);

        echo "<div class='alert success'>
                <p>Thème réactivé avec succès</p>
              </div>";
    } else {
        // si non il est dèja actif
        echo "
        <div class='alert error'>
            <p>Le thème existe déjà et est déjà actif</p>
        </div>";
    }
 

}

else{
// si le thème n'existe dèja on le crée
$ajout = "insert into themes values (NULL,'$nom',0,'$descriptif')";


    $result = mysqli_query($connect, $ajout);
    
    if (!$result)
    {
    echo "<div class='alert error'> 
                <p>La requête n'a pas pu aboutir</p>
                <div>";
    exit();
    }
    else{
    echo"<div class='alert success'>   
             <p> le nom saisie est : $nom  </p>
             <p>la description saisie est : $descriptif </p>
             <p>Thème ajouté avec succès.</p>
          </div>
          <forms>
          <input type='button' onclick=\"window.location='ajout_theme.html'\"  value='Retourner' >
          </forms>";
            
    }
}


mysqli_close($connect);





    ?>
    </body>
</html>