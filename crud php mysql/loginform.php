<?php
$existujeUzivatel = false;
$login = $heslo = "";
$logErr = $hesErr = $zprava = "";
$file = "";

$_SESSION["loginUziv"]="";
$_SESSION["hesloUziv"]="";
$_SESSION["jmenoUziv"]="";  
$_SESSION["prijmeniUziv"]="";
$_SESSION["emailUziv"]="";
$_SESSION["id"]=0;


if($_SERVER["REQUEST_METHOD"]=="POST"){
  $servername = "localhost";
  $username = "root";
  $password = "root";

    if(empty($_POST["login"])){
      $logErr = "uživatelské jméno je povinné !";
    }else{
      $login = test_input($_POST["login"]);
    }
    

    if(empty($_POST["heslo"])){
        $hesErr = "heslo je povinné !";
    }else{
      $heslo = test_input($_POST["heslo"]);
    }


      if(!empty($_POST["heslo"]) AND !empty($_POST["login"])){
        try {
          $conn = new PDO("mysql:host=$servername;dbname=myfirstdb", $username, $password);
          // set the PDO error mode to exception
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $result =$conn->query("SELECT * FROM Uzivatele WHERE Login = '$login' AND Heslo = '$heslo' ");

          if(!empty($row = $result->fetch())){
            $existujeUzivate = true;
            $zprava = "Zkuste znovu!";
            $file = "index.php";
            $_SESSION["isLogged"]= true;

            $_SESSION["loginUziv"]= $row['Login'];
            $_SESSION["hesloUziv"]= $row['Heslo'];
            $_SESSION["jmenoUziv"]= $row['Jmeno'];
            $_SESSION["prijmeniUziv"]= $row['Prijmeni'];
            $_SESSION["emailUziv"]=$row['Email'];
            $_SESSION["id"] = $row['ID'];

          }else{
            $zprava = "Uzivatel neexistuje !";
            $file = "login.php";
          }

        }catch(PDOException $e) {
         echo "ERROR: " . $e->getMessage();
        }
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
    <form class="form" action="<?php echo htmlspecialchars($file);?>" method="post">

        <div class="row">
        <label>Uzivatelské jmeno(Login):</label>
        <input type="text" name="login">
        </div>

        <span class="error"><?php echo $logErr;?></span>

        <div class="row">
        <label>Heslo:</label>
        <input type="password" name="heslo">
        </div>

        <span class="error"><?php echo $hesErr;?></span>

        <div class="row">
        <label></label>
        <input type="submit" name="submit" value="Přihlasit">
        </div>

        <span class="error"><?php echo $zprava;?></span>
        
    </form>
</article>