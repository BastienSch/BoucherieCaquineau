<?php
require 'infoWeb.php';  				
?>
<!DOCTYPE html>
<html>
<?php  require 'require/head.php' ?>
<body>
<?php  require 'require/navbar.php' ?>
<div class="container ">
	<div class="row  ">
    	<div class="column column-100 titre">
    		<h3 class="titre">Ajouter des Viandes :</h3>
    	</div>

    </div>
    <br/>
  	<div class="row content">
	    <div class="column column-100 ">
	       	<form action="infoWeb.php">
				 <br>Nom de l'animal :<br>
				 <select name="idAnimal">
					   <?php 
					    	$infoWeb = new InfoWeb();
    						$infoWeb->animalSelect(); 
    					?>
				  </select>
				  Nom du morceau :<br>
				  <select name="idMorceau">
					   <?php 
					    	$infoWeb = new InfoWeb();
    						$infoWeb->morceauSelect(); 
    					?>
				  </select>
				  
				  <input name="addViande" value="addViande" type="text" hidden>
				  <br>
				  <input type="submit" value="Ajouter">
			</form>   
  		</div>
	</div>
</div>
</body>
</html>