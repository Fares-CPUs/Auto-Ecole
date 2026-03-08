<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css" type="text/css">
</head>

 <?php 
    $date = date("Y-m-d");
    ?>

<body>
  <h1 class="form-title">Noter les éleves</h1>
  <FORM METHOD='POST' ACTION='noter_eleves.php' >
   <input type="hidden" name="idseance" value="<?php echo $_POST['idseance']; ?>">


   
    <?php
      
      $dbhost = 'tuxa.sme.utc';
      $dbuser = 'nf92a007'; 
      $dbpass = '03ztVCZs8gJg'; 
      $dbname = 'nf92a007'; 
      $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die
      ('Error connecting to mysql');
    
      mysqli_set_charset($connect, 'utf8'); 

      $result = mysqli_query($connect,"SELECT 
    s.nom AS student_name, 
    r.note, 
    s.ideleve
FROM Inscription r
INNER JOIN eleves s 
    ON r.ideleve = s.ideleve
WHERE r.idseance = ".$_POST["idseance"]. ";
"); //WHERE actif = 1
      // ATTENTION il manque les affichages et tests de debugage !!!!

   

if(mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
      {

              echo
              "<p>".$row[0]."</p>   
              <input id='effMax' type='number' name='eleve_$row[2]' maxlength='3' size='3' min='0' max='40' value='$row[1]' > </br> ";
        
      }

      }
      
       else{
         echo"<option value='' disabled selected>Auncune élève inscrit</option>";
      }


      
      mysqli_close($connect);


    ?>

  </select>
  <div>
    <input type='submit' value='OK'>
  </div>

 
</FORM>





</body>
</html>
