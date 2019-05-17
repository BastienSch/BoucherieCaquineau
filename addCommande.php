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
    		<h3 class="titre">Ajouter une commande :</h3>
    	</div>

    </div>
    <br/>
  	<div class="row content">
	    <div class="column column-100 ">
	       	<form action="infoWeb.php">
				  <br>Fournisseur :<br>
				   <select name="fournisseur">
					   <?php 
					    	$infoWeb = new InfoWeb();
    						$infoWeb->fournisseurSelect(); 
    					?>
				  </select><br>
				  Date de la commande :<br>
				  <input name="date" type="date" ><br>
				  Montant de la commande :<br>
				  <input name="montant" type="text" ><br>
				  Viande :<br>
				  <select name="viande">
					   <?php 
					    	$infoWeb = new InfoWeb();
    						$infoWeb->viandeSelect(); 
    					?>
				  </select><br>
				  Quantité :<br>
				  <input name="quantite" type="text" ><br>
				  <input name="addCommande" value="addCommande" type="text" hidden>
				  <br>
				  <input type="submit" value="Ajouter">
			</form>   
  		</div>
	</div>
</div>
</body>
</html>