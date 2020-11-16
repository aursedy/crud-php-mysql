<?php 
  $servername = "localhost";
  $username = "root";
  $password = "root";

  $login =  $_SESSION["loginUziv"];
  $heslo =  $_SESSION["hesloUziv"];
  $jmeno =  $_SESSION["jmenoUziv"];
  $prijmeni =  $_SESSION["prijmeniUziv"];
  $email =  $_SESSION["emailUziv"];
  $id = $_SESSION["id"];
  
  $loginErr = $hesloErr= $emailErr = $jmenoErr = $prijmeniErr = "";
  $zprava = "";

  if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty($_POST["jmeno"])){
      $jmenoErr = "jméno je povinné !";
    }else{
      $jmeno = test_input($_POST["jmeno"]);

      if (!preg_match("/^[a-zA-Z-' ]*$/",$jmeno)) {
      $jmenoErr = "Jen pismeno a bilí znaci jsou povoleni !";
      }
    }

    if(empty($_POST["prijmeni"])){
      $prijmeniErr= "přijmení je povinné !";
    }else{
      $prijmeni = test_input($_POST["prijmeni"]);

      if (!preg_match("/^[a-zA-Z-' ]*$/",$prijmeni)) {
      $prijmeniErr = "Jen pismeno a bilí znaci jsou povoleni !";
      }
    }

    if(empty($_POST["email"])){
      $emailErr = "email je povinný !";
    }else  {
      $email = test_input($_POST["email"]);

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Neplatný format emailu !";
      }  
    }

    if(empty($_POST["login"])){
      $loginErr = "uživatelské jméno je povinné !";
    }else{
      $login = test_input($_POST["login"]);

      if (!preg_match("/^[a-zA-Z-' ]*$/",$login)) {
      $loginErr = "Jen pismeno a bilí znaci jsou povoleni !";
      }
    }
    

    if(empty($_POST["heslo"])){
        $hesloErr = "heslo je povinné !";
    }else{
      $heslo = test_input($_POST["heslo"]);
    }
      
    //ukladám udaje do databaze
    try {
      $conn = new PDO("mysql:host=$servername;dbname=myfirstdb", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "UPDATE Uzivatele SET Jmeno = '$jmeno',Prijmeni ='$prijmeni',Email='$email',Login='$login',Heslo='$heslo' WHERE Id=$id ";

      if($conn->query($sql)==true){
        $zprava = "Uspěsný update!";
      }else{
        $zprava = "ERROR update:".$conn->error;
      }

    } catch(PDOException $e) {
      echo "ERROR: " . $e->getMessage();
    }

    }
  
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

?>

<article>
    <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="row">
        <label>Jméno:</label>   
        <input type="text" name="jmeno" value="<?php echo $jmeno ;?>">    
        </div>

        <span class="error"><?php echo $jmenoErr;?></span>

        <div class="row">
        <label>Přijmení:</label>   
        <input type="text" name="prijmeni" value="<?php echo $prijmeni ;?>">
        </div>

        <span class="error"> <?php echo $prijmeniErr;?></span>

        <div class="row">
        <label>email:</label>
        <input type="email" name="email" value="<?php echo $email ;?>">
        </div>

        <span class="error"><?php echo $emailErr;?></span>

        <div class="row">
        <label>Uzivatelské jmeno(Login):</label>
        <input type="text" name="login" value="<?php echo $login ;?>">
        </div>
    
        <span class="error"><?php echo $loginErr;?></span>

        <div class="row">
        <label>Heslo:</label>
        <input type="password" name="heslo" value="<?php echo $heslo ;?>">
        </div>

        <span class="error"><?php echo $hesloErr;?></span>
          
        <div class="row">
        <label></label>
        <input type="submit" name="submit" value="Ulozit">
        </div>

        <span class="error"><?php echo $zprava;?></span>
    </form>
</article>