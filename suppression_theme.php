<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ajouter une séance</title>
        <link rel="stylesheet" href="style.css" type="text/css">
    </head>
    <body>
        <h1 class="form-title">Supprimer un thème</h1>
        <?php
            date_default_timezone_set('Europe/Paris');
            $date = date("Y-m-d");
            $dbhost = 'tuxa.sme.utc';
            $dbuser = 'nf92a007';
            $dbpass = '03ztVCZs8gJg';

            $dbname = 'nf92a007';

            $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');

            mysqli_set_charset($connect, 'utf8'); 



            $id = $_POST['idtheme'];

                    $sql = "UPDATE themes
                            SET supprime = 1
                            WHERE themes.idtheme = $id";

            $result = mysqli_query($connect, $sql);

            if (!$result) {
                echo "<div class='alert error'> 
                                <p>La requête n'a pu aboutir</p>
                                <div>";;
            } else {
                echo "<div class='alert success'>   
                        thème supprimé avec succès
                        <forms>
                            <input type='button' onclick=\"window.location='supprimer_theme.php'\"  value='Retourner' >
                        </forms> </div>";
            }

            mysqli_close($connect);




        ?>
    </body>
</html>