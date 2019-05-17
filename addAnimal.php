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
    		<h3 class="titre">Ajouter un animal :</h3>
    	</div>

    </div>
    <br/>
  	<div class="row content">
	    <div class="column column-100 ">
	       	<form action="infoWeb.php">
				  Nom de l'animal :<br>

				  <input name="libelle" type="text" ><br>
				  <input name="addAnimal" value="addAnimal" type="text" hidden>
				  <br><br>
				  <input type="submit" value="Ajouter">
			</form>   
  		</div>
	</div>
</div>
</body>
</html>