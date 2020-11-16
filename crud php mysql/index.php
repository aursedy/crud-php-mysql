<?php
// session_start();

if(!empty($_POST["login"]) AND !empty($_POST["heslo"])){
    $_SESSION["isLogged"]=true;
}else{
     $_SESSION["isLogged"]=false;
}

?>

<!DOCTYPE html>
<html>
<title>Mpoungui Ngoyi Francis</title>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

	<header>
	    <a href="index.php"><img src="obrazky/logo.png" id="logo"></a>
	    <p>Zviřata</p>
    </header>


    <section class="mainSection">
    	<?php include "navbar.php" ?>

    	<?php include "maincontent.php"?>
    </section>
    <footer>
        <p>@Mpoungui Ngoyi Francis Aursedy 2020</p>
    </footer>
</body>

</html>