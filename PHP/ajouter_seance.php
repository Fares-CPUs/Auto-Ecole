<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
        <title>Ajouter une séance</title>
        <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>
      <h1 class="form-title">Ajouter une séance</h1>
    <?php
        //conexion à la base
        date_default_timezone_set('Europe/Paris');
        $date = date("Y-m-d");
        $dbhost = 'tuxa.sme.utc';
        $dbuser = 'nf92a007';
        $dbpass = '03ztVCZs8gJg';
        $dbname = 'nf92a007';

        $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');

        mysqli_set_charset($connect, 'utf8'); 


        // verification 
        if (empty($_POST['dateSeance']) || empty($_POST['effMax']) || empty($_POST['theme']) ) {
            echo "<div class='alert error'> 
                    <p>Ereur 404: Un champ de saisie est vide</p>
                    <div>";
            exit();
        }

        // cette fonction permet l'utilisation des caractères spéciaux
        $dateS = mysqli_real_escape_string($connect, $_POST['dateSeance']); // a condition que 'nom' soit le bon 'name'! expliquez.
        $effMax= mysqli_real_escape_string($connect, $_POST['effMax']);
        $theme = mysqli_real_escape_string($connect, $_POST['theme']);

        //requete pour ajouter la seances a la base
        $query = "insert into seances values (NULL,'$dateS','$effMax','$theme')";
        

        $result = mysqli_query($connect, $query);
       
        if (!$result)
        {
        echo "<div class='alert error'> pas bon </div> ".mysqli_error($connect);
        }

        echo"<div class='alert success'>   
             <p> le numèro du thème de la sèance: $theme  </p>
             <p> Elle aura lieu le : $dateS </p>
              <p> avec un effectif maximal de : $effMax </p>
             <p>Sèance ajouté avec succès.</p>
          </div>
          <forms>
          <input type='button' onclick=\"window.location='ajout_seance.php'\"  value='Retourner' >
          </forms>";

        mysqli_close($connect);





    ?>
</body>
</html>