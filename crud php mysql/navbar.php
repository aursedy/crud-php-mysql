<?php 
  session_start();
?>
<nav>
    <p style="font-size: 20px;font-weight: bold;text-align: center;">Menu</p>
 	<ul>
  	    <li style="text-align: center;"><a href="stranka3.php">Kontact</a></li>
  	    <li style="text-align: center;"><a href="register.php">Registrace</a></li>
  	    <?php 
         if($_SESSION["isLogged"]){
         	echo'<li style="text-align: center;"><a href="logout.php">Odhlasit</a></li>';
         	echo'<li style="text-align: center;"><a href="clientProfile.php">Udaje</a></li>';
         }else{
         	echo '<li style="text-align: center;"><a href="login.php">Přihlasit</a></li>';
         }
  	    ?>	    	    
  	</ul>
</nav>