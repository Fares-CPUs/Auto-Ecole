<html>
    <head>
    <meta charset="utf-8">
  <link rel="stylesheet" href="style.css" type="text/css">
    </head>
<body>

<h1>Informations de l'élève</h1>

<?php

$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a007';
$dbpass = '03ztVCZs8gJg';
$dbname = 'nf92a007';

$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)
    or die("Erreur de connexion MySQL");
mysqli_set_charset($connect, "utf8");

if (!isset($_POST['ideleve'])) {
    die("<h2>Aucun élève sélectionné.</h2>");
}

$ideleve = $_POST['ideleve'];


$reqEleve = "
    SELECT nom, prenom, dateNaiss 
    FROM eleves 
    WHERE ideleve = $ideleve
";

$resEleve = mysqli_query($connect, $reqEleve) 
    or die("Erreur requête élève");

$eleve = mysqli_fetch_assoc($resEleve);
$nom = $eleve['nom'];
$prenom = $eleve['prenom'];
$dateN = $eleve['dateNaiss'];

if (!$eleve) {
    die("<h2>Élève introuvable</h2>");
}
else{
    echo " 
<p><b>Nom :</b>  $nom </p>
<p><b>Prénom :</b> $prenom </p>
<p><b>Date de naissance :</b> $dateN  </p>
 <forms>
  <input type='button' onclick=\"window.location='consulter_eleve.php'\"  value='Retourner' >
 </forms>";
}
   
?>

</body>
</html>
