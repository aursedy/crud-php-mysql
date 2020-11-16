<?php 
session_start();

session_destroy();
?>
<!DOCTYPE html>
<html>
<title>Odhlašení</title>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
	<header>
	    <a href="index.php"><img src="obrazky/logo.png" id="logo"></a>
	    <p>Odhlšení</p>
    </header>


    <section class="mainSection">
    	<?php include("navbar.php")?>

    	<?php echo"Uspěšné odhlšení!";?>
    </section>
    <footer>
        <p>@Mpoungui Ngoyi Francis Aursedy 2020</p>
    </footer>
</body>

</html>