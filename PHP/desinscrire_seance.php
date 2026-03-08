<?php
date_default_timezone_set('Europe/Paris');

// Connexion a la base
   $dbhost = 'tuxa.sme.utc';
      $dbuser = 'nf92a007'; 
      $dbpass = '03ztVCZs8gJg'; 
      $dbname = 'nf92a007'; 
      $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die
      ('Error connecting to mysql');

mysqli_set_charset($connect, 'utf8');

/*
- je veut afficher les séances futures de chaque élève
et on a besoin de l'id de l'élève et de l'id de la séance pour pouvoir
  désinscrire correctement un élève d'une séance
*/
$sql = "
SELECT 
    eleves.ideleve,
    eleves.nom,
    seances.idseance,
    seances.DateSeance,
    themes.nom as tnom
FROM Inscription
JOIN seances ON Inscription.idseance = seances.idseance
JOIN eleves ON Inscription.ideleve = eleves.ideleve
JOIN themes ON seances.idtheme = themes.idtheme
WHERE seances.DateSeance > CURDATE()
ORDER BY eleves.ideleve, seances.DateSeance;

";





$result = mysqli_query($connect, $sql);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Désinscription</title>
 <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>

<h1>Désinscrire un élève</h1>

<form method="POST" action="desinscription_seance.php">

<table border="1">
<tr>
    <th>Nom</th>
    <th>Choisir</th>
    <th>Date</th>
    <th>Thème</th>
</tr>

<?php
$dernierEleve = 0;
$vide = true;

while ($row = mysqli_fetch_assoc($result)) {

    $vide = false;

    echo "<tr>";

    // Afficher l'eleve une seule fois
    if ($dernierEleve != $row['ideleve']) {
        echo "<td>" . $row['nom'] . "</td>";
        $dernierEleve = $row['ideleve'];
    } else {
        echo "<td></td>";
    }

    echo "<td>
            <input type='radio' name='combinaison'
                   value='".$row['ideleve']."-".$row['idseance']."'>
          </td>";

    echo "<td>".$row['DateSeance']."</td>";
    echo "<td>".$row['tnom']."</td>";

    echo "</tr>";
}

// cas du aucun résultat
if ($vide) {
    echo "<tr><td colspan='4'>Aucune séance future</td></tr>";
}
mysqli_close($connect);
?>

</table>

<br>
<button type="submit">Désinscrire un élève</button>

</form>

</body>
</html>
