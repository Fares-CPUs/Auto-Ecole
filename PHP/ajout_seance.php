<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css" type="text/css">
</head>


<body>
  <h1 class="form-title">Ajouter une séance</h1>

  <form METHOD='POST' ACTION='ajouter_seance.php' >

      <label for="dateSeance">Date de la séance</label>
      <input id="dateSeance" type="date" name="dateSeance" min="<?php echo $date; ?>" required/>
      <label for="effMax">Effectif max</label>
      <input id="effMax" type="number" name="effMax" maxlength="3" size="3" min="1" required/>

      <label for='theme'>Thème</label>
      <select id='theme' name='theme' required>
   
          <?php
            
            //connexion à la base
            $dbhost = 'tuxa.sme.utc';
            $dbuser = 'nf92a007'; 
            
            $dbpass = '03ztVCZs8gJg';
            
            $dbname = 'nf92a007'; 

            $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die
            ('Error connecting to mysql');

            // Définition de l'encodage
            mysqli_set_charset($connect, 'utf8'); 

            // Récupération des thèmes 
            $result = mysqli_query($connect,"SELECT * FROM themes WHERE supprime = 0 ");
            if(mysqli_num_rows($result) > 0){
             // Affichage des thèmes actifs dans la liste déroulante
                while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
                {
                  if($row[2] == 0){
                        echo
                        "<option value =".$row[0].">".$row[1]."</option>";
                  }
                }
            }
            else
            {
              echo"<option value='' disabled selected>Auncun thème existe</option>";
            }

            mysqli_close($connect);
            
          ?>

      </select>

  <div class="form-submit">
    <input type='submit' value='OK'>
  </div>

</FORM>





</body>
</html>
