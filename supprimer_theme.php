<html >
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css" type="text/css">
</head>

 

<body>
  <h1 class="form-title">Supprimer un thème</h1>
  <FORM METHOD='POST' ACTION='suppression_theme.php' >

  <label for='theme'>Thème</label>
  <select id='theme' name='idtheme' required>
   
    <?php

  
      $date = date("Y-m-d");
      //connexion à la base
      $dbhost = 'tuxa.sme.utc';
      $dbuser = 'nf92a007'; 
      $dbpass = '03ztVCZs8gJg'; 
      $dbname = 'nf92a007'; 
      $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die
      ('Error connecting to mysql');
    
      mysqli_set_charset($connect, 'utf8'); 
      $result = mysqli_query($connect,"SELECT * FROM themes WHERE supprime = 0"); 
    
      
       if(mysqli_num_rows($result) > 0){
          while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
        {
          if($row[2] == 0){
                echo
                "<option value =".$row[0]." >".$row[1]."</option>";
          }
        }
      }
      else{
         echo"<option value='' disabled selected>Auncun thème existe</option>";
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
