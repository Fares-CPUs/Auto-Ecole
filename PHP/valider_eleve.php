   <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css" type="text/css">
    <h1 class="form-title">Valider un élève</h1>
        
<?php
date_default_timezone_set('Europe/Paris');
            $date = date("Y-m-d");
$dbhost = 'tuxa.sme.utc';
            $dbuser = 'nf92a007';

            $dbpass = '03ztVCZs8gJg';

            $dbname = 'nf92a007';

            $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');

            mysqli_set_charset($connect, 'utf8'); 

$nom = mysqli_real_escape_string($connect, $_POST['nom']);
            $prenom = mysqli_real_escape_string($connect, $_POST['prenom']);
            $dateN = mysqli_real_escape_string($connect, $_POST['Ndate']);
            

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Confirm</title>
</head>
<body>

<?php
            $query = "insert into eleves values (NULL,'$nom','$prenom','$dateN','$date')";
            $result = mysqli_query($connect, $query);

            if (!$result)
            {
                echo "<br>pas bon  ".mysqli_error($connect);
            }
            else{
                    
                echo "<p> le nom saisie est : $nom $prenom</p>";
                echo "<p> la date saisie est : $dateN</p>";
                
                echo "<p>Elève ajouté avec succès</p>
                
                    <forms>
                    <input type='button' onclick=\"window.location='ajout_eleve.html'\"  value='Retourner' >
                    </forms>";
            }
            mysqli_close($connect);
?>


</body>
</html>
