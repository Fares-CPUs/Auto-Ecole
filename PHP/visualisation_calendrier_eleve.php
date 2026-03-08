<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Élève</title>
</head>

<body>
<?php
//connexion
$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a007';
$dbpass = '03ztVCZs8gJg';
$dbname = 'nf92a007';

$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)
    or die("Erreur de connexion MySQL");
mysqli_set_charset($connect, "utf8");

//verification
if (!isset($_POST['ideleve'])) {
    die("<h2>Aucun élève sélectionné.</h2>");
}

$ideleve = intval($_POST['ideleve']);

$date = date("Y-m-d");

// prendre les seances dans le future
$reqSeances = "
    SELECT 
        Inscription.idseance,
        seances.DateSeance,
        themes.nom
    FROM Inscription
    JOIN seances ON Inscription.idseance = seances.idseance
    JOIN themes ON seances.idtheme = themes.idtheme
    WHERE Inscription.ideleve = $ideleve
      AND seances.DateSeance > '$date'
    ORDER BY seances.DateSeance ASC
";


$resSeances = mysqli_query($connect, $reqSeances)
    or die("Erreur requête séances");

?>
<h1>Seances de l'élève</h1>

<h2>Liste des séances</h2>

<table border="1" cellpadding="6"">
    <tr>
        <th> Séance</th>
        <th>Date</th>
      
    </tr>

<?php
if (mysqli_num_rows($resSeances) == 0) {
    echo "<tr><td colspan='4'><i>Aucune séance trouvée</i></td></tr>";
} else {
    while ($row = mysqli_fetch_assoc($resSeances)) { // loop sur les rows
        echo "<tr>";
        echo "<td>".$row['nom']."</td>";
        echo "<td>".$row['DateSeance']."</td>";
        echo "</tr>";
    }
}


?>

</table>
<?php 

echo "<forms>
        <input type='button' onclick=\"window.location='supprimer_theme.php'\"  value='Retourner' >
     </forms>"
?>
</body>
</html>
