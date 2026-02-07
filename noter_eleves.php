<!DOCTYPE html>
<html>
    <head>
           <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css" type="text/css">
    <Title>Noter un élève</Title>
    
    </head>
    <body>
    <h1 class="form-title">Noter les élèves</h1>
    <div class='alert success'>   
               
    <?php

        date_default_timezone_set('Europe/Paris');
        $date = date("Y-m-d");
        $dbhost = 'tuxa.sme.utc';
        $dbuser = 'nf92a007';
        
        $dbpass = '03ztVCZs8gJg';
        
        $dbname = 'nf92a007';
       
        $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
       
        mysqli_set_charset($connect, 'utf8'); 

        $idseance = $_POST['idseance']; 
        $saut = 0;
        foreach ($_POST as $key => $value) { // on utilise le nom et la valeur de variable pour la sasie key = ideleve , value = faute
            if ($saut == 1){

                
                $id = substr($key, 6);   //  enleves les 6 premier lettre eleve_id

                
               if (isset($_POST["$key"])) {
                     $note = $_POST["$key"];
                    }                 
                    else {
                       $note = 'NULL';
                    }

              

                // update sur les note de l'eleve
                $sql = "UPDATE Inscription 
                        SET note = $note 
                        WHERE ideleve = $id AND idseance = $idseance";

                echo $sql;

                echo "<p>La note de l'élève avec id (".$id.") a bien était prise en compte</p>
                    <forms>
                        <input type='button' onclick=\"window.location='validation_seance.php'\"  value='Retourner' >
                    </forms>";
                mysqli_query($connect, $sql);
            }
            else{
                $saut = 1;
            }
        }

        mysqli_close($connect);

    ?>
     </div>
</body>
</html>