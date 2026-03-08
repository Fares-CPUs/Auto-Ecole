<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css" type="text/css">
</head>

 <?php 
    $date = date("Y-m-d");

    ?>

<body>
  <h1 class="form-title">Inscrire un éleve</h1>
  <FORM METHOD='POST' ACTION='inscription_eleve.php' >

  <label for='seance'>séance</label>
  <select id='seance' name='idseance' required>

  
   
    <?php
      $dbhost = 'tuxa.sme.utc';
      $dbuser = 'nf92a007'; 
      $dbpass = '03ztVCZs8gJg'; 
      $dbname = 'nf92a007'; 
      $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die
      ('Error connecting to mysql');
      //la ligne suivante permet d'éviter les problèmes d'accent entre la page
      //ouèbe et le serveur mysql
      mysqli_set_charset($connect, 'utf8'); 

        $sql = "SELECT idseance , dateseance , nom 
        FROM seances 
        INNER JOIN themes ON seances.idtheme = themes.idtheme 
        WHERE DateSeance >= '$date' ORDER BY DateSeance;";

  
      $result = mysqli_query($connect,$sql); //WHERE actif = 1
      // ATTENTION il manque les affichages et tests de debugage !!!!
     
      if(mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
        {
          
                echo
                "<option value =".$row[0].">".$row[1].":".$row[2] ."</option>";
          
        }
      }
      else{
         echo"<option value='' disabled selected>Auncun séance existe</option>";
      }
      
    ?>

      </select>
        <label for='eleves'>élèves</label>
        <select id='eleves' name='ideleve' required>
         

      <?php
       $result = mysqli_query($connect,"SELECT * FROM eleves "); 
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
         echo "</select>";
      ?>
        
    <br>

   
    <input type='submit' value='OK'>
  

    
</FORM>





</body>
</html>
