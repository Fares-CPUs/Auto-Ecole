<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Inscription d'un élève</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 class="form-title">Confirmation</h1>

    <?php
        date_default_timezone_set('Europe/Paris');

        // Connexion à la base *
        $dbhost = 'tuxa.sme.utc';
        $dbuser = 'nf92a007';
        $dbpass = '03ztVCZs8gJg';
        $dbname = 'nf92a007';

        $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Error connecting to MySQL');
        mysqli_set_charset($connect, 'utf8');

        // Vérification des champs 
        if (empty($_POST['idseance']) || empty($_POST['ideleve'])) {
            echo "<div class='alert error'>
            <p>Erreur : un champ est vide</p>
            </div>";
            exit();
        }

        $idseance = mysqli_real_escape_string($connect, $_POST['idseance']);
        $ideleve  = mysqli_real_escape_string($connect, $_POST['ideleve']);

        // Vérifie si l'élève est déjà inscrit 
        $queryCheck = "SELECT * FROM Inscription 
                    WHERE ideleve = $ideleve 
                    AND idseance = $idseance";
        $resultCheck = mysqli_query($connect, $queryCheck);

        if (!$resultCheck) {
            echo "<div class='alert error'>
            <p>Erreur</p>
            </div>";
            exit();
        }

        if (mysqli_num_rows($resultCheck) > 0) {
            echo "<div class='alert error'>
            <p>L'élève est déjà inscrit à cette séance.</p>
            </div>";
            exit();
        }

        // Vérifie l'effectif maximum
        $queryMax = "SELECT EffMax FROM seances WHERE idseance = $idseance";
        $resultMax = mysqli_query($connect, $queryMax);

        if (!$resultMax) {
            echo "<div class='alert error'>
            <p>Erreur </p>
            </div>";
            exit();
        }

        $rowMax = mysqli_fetch_assoc($resultMax);
        $effmax = $rowMax['EffMax'];

        // Compte le nombre d'inscriptions actuelles 
        $queryCount = "SELECT * FROM Inscription WHERE idseance = $idseance";
        $resultCount = mysqli_query($connect, $queryCount); // caractere speaciale

        if (mysqli_num_rows($resultCount) >= $effmax) {
            echo "<div class='alert error'>
            <p>La séance est déjà complète, impossible d'inscrire cet élève.</p>
            </div>";
            exit();
        }

        // Inscription de l'élève
        $queryInsert = "INSERT INTO Inscription (idseance, ideleve) VALUES ($idseance, $ideleve)";
        $resultInsert = mysqli_query($connect, $queryInsert);

        if (!$resultInsert) {
            echo "<div class='alert error'>
            <p>Erreur</p>
            </div>";
        } else {
            echo "<div class='alert success'>
                    <p>ID séance : $idseance</p>
                    <p>ID élève : $ideleve</p>
                    <p>Élève inscrit avec succès !</p>
                </div>
                <forms>
                 <input type='button' onclick=\"window.location='inscrire_eleve.php'\"  value='Retourner' >
                </forms>";
        }

     
        mysqli_close($connect);
    ?>
</body>
</html>
