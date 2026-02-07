<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Désinscription d'un élève</title>
 <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Désinscription d'un élève</h1>


    <?php
        if (!isset($_POST['combinaison'])) {
            echo "Aucune séance sélectionnée.";
            exit;
        }

        list($ideleve, $idseance) = explode('-', $_POST['combinaison']); // separe la chaine celon le tirer sur les deux variables

        $dbhost = 'tuxa.sme.utc';
        $dbuser = 'nf92a007';
        $dbpass = '03ztVCZs8gJg';
        $dbname = 'nf92a007';

        $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

        if (!$connect) {
            die("Erreur de connexion à la base de données.");
        }

        $sql = "DELETE FROM Inscription WHERE ideleve=$ideleve AND idseance=$idseance";

        if (mysqli_query($connect, $sql)) {
            echo "<div class='alert success'
                  <p>Élève $ideleve désinscrit de la séance $idseance</p>
                  </div>
                  <forms>
                      <input type='button' onclick=\"window.location='desinscrire_seance.php'\"  value='Retourner' >
                  </forms>";
        } else {
            echo "<div class='alert error' >
                  <p>Erreur lors de la désinscription : </p>
                  <div>";
        }

        mysqli_close($connect);
        ?>


</body>
</html>
