<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css" type="text/css">
</head>

 <?php 
  //connexion à la base
    $date = date("Y-m-d");
    $dbhost = 'tuxa.sme.utc';
      $dbuser = 'nf92a007'; 
      $dbpass = '03ztVCZs8gJg'; 
      $dbname = 'nf92a007'; 
      $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die
      ('Error connecting to mysql');
      
      mysqli_set_charset($connect, 'utf8'); 

    ?>

<body>
     <h1 class="form-title">Consulter un éleve</h1> 
      <FORM METHOD='POST' ACTION='consultation_eleve.php' >
      </select>
        <label for='eleves'>élèves</label>
        <select id='eleves' name='ideleve' required>
      <?php
      //creation du forum pour consulter un eleve 


       $result = mysqli_query($connect,"SELECT * FROM eleves "); //recupération de tout les éleves et leur ID 
    
     

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
         echo "</select>"
      ?>
        
    <br>

  
    <input type='submit' value='OK'>
  
</FORM>





</body>
</html>
