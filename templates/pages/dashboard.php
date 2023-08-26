<?php
   require_once('src/Codes.php');

   $userID = $data['id'] ?? '';
   $login = $data['login'] ?? '';
   $finalCode = $data['finalCode'] ?? '';
   $userCodes = $data['userCodes'] ?? [];
   $winner = $data['winner'] ?? '';
   
   if(isset($_GET['before']) && $_GET['before'] === 'codeAdded') {
      echo "<h2>DODANO KOD</h2>";
   } elseif(isset($_GET['before']) && $_GET['before'] === 'codeNoAdded') {
      echo "<h2>NIEPOPRAWNY KOD</h2>";
   }
?>

<section>
   --DASHBOARD--<br/><br/>
   <?php
      echo "Witaj, $login! Twoje id to $userID.";
      echo "<br/><br/>";
      echo "<a href='index.php?action=addCode&userID=$userID'>Zarejestruj swój kod</a> <br/><br/>";
      

      echo "<b>Twoje kody: </b><br/>";
      foreach($userCodes as $code) {
         if(is_array($code)) {
            foreach($code as $innerCode) {
               echo $innerCode."<br/>";
            }
         }
      }
      echo "<br/><b>Wygrywajacy kod: $finalCode</b><br/><br/>";

      if($winner) echo "***WINNER***";
      else echo "*LOOSER*";
   ?>
</section>