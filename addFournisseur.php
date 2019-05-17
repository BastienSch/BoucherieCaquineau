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
    		<h3 class="titre">Ajouter un Fournisseur :</h3>
    	</div>

    </div>
    <br/>
  	<div class="row content">
	    <div class="column column-100 ">
	       	<form action="infoWeb.php">
				  <br>Nom de l'entreprise :<br>
				  <input name="nomEntreprise" type="text" ><br>
				  Rue :<br>
				  <input name="rue" type="text" ><br>
				  Ville :<br>
				  <input name="ville" type="text" ><br>
				  Numéro de téléphone :<br>
				  <input name="tel" type="text" ><br>
				  Adresse E-mail :<br>
				  <input name="mail" type="text" ><br>
				  Département :<br>
				  <select name="CP">
					   <?php 
					    	$infoWeb = new InfoWeb();
    						$infoWeb->departementSelect(); 
    					?>
				  </select>
				  Secteur d'activité :<br>
				  <select name="idSecteur">
					   <?php 
					    	$infoWeb = new InfoWeb();
    						$infoWeb->secteurSelect(); 
    					?>
				  </select>

				  <input name="addFournisseur" value="addFournisseur" type="text" hidden>
				  <br><br>
				  <input type="submit" value="Ajouter">
			</form>   
  		</div>
	</div>
</div>
</body>
</html>