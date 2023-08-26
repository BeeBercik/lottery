<section>

<?php
   $userID = $data['id'];
?>

   <form action="index.php" method="POST">
      Wpisz kod<br/>
      <input type="text" name='code'><br/>
      <input type="hidden" name="userID" value=<?php echo $userID ?>>
      <input type="submit" value="Dodaj">
   </form>

</section>