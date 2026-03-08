
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css" type="text/css">
</head>

 <?php 
    $date = date("Y-m-d");
    $dbhost = 'tuxa.sme.utc';
      $dbuser = 'nf92a007'; // remplacer les SXXX avec le semestre et le
      //numero de votre compte
      // exemples nf92p014 ou nf92a078
      $dbpass = '03ztVCZs8gJg'; // remplacer votremotdepasse par votre
      //mot de passe
      $dbname = 'nf92a007'; // remplacer les SXXX comme indiqué ci-desus
      $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die
      ('Error connecting to mysql');
      //la ligne suivante permet d'éviter les problèmes d'accent entre la page
      //ouèbe et le serveur mysql
      mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont

    ?>

<body>
  <h1 class="form-title">consulter les séances d'un éleve</h1>
  <FORM METHOD='POST' ACTION='visualisation_calendrier_eleve.php' >

  
   


      </select>
        <label for='eleves'>élèves</label>
        <select id='eleves' name='ideleve' required>
         

      <?php



       $result = mysqli_query($connect,"SELECT * FROM eleves "); //WHERE actif = 1
      // ATTENTION il manque les affichages et tests de debugage !!!!
    
      

        if(mysqli_num_rows($result) > 0){
          while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
        {
          if($row[1] > $date){
                echo
                "<option value =".$row[0].">".$row[1]." ".$row[2] ."</option>";
          }
        }
      }
      else{
         echo"<option value='' disabled selected>Auncun élève existe</option>";
      }

      
         mysqli_close($connect);
         echo "</br>"
      ?>
        
    </br>

  
    <input type='submit' value='OK'>
  
</FORM>





</body>
</html>
