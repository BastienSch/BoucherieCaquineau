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
    		<h3 class="titre">Modifier ce fournisseur :</h3>
    	</div>

    </div>
    <br/>
  	<div class="row content">
	    <div class="column column-100 ">
	       	<form action="infoWeb.php">
				  <br>Fournisseur :<br>
				  <select name="nomEntreprise">
					   <?php 
					    	$infoWeb = new InfoWeb();
    						$infoWeb->fournisseurSelected($_GET['nomEntreprise']); 
    					?>
				  </select><br>
				  Montant :<br>
				  <input name="montant" type="text" value=<?php echo $_GET['montant'] ?>><br>
				  Date :<br>
				  <input name="date" type="text" value=<?php echo $_GET['dateC'] ?>><br>
				  Viande :<br>
				  <select name="viande" >
					   <?php 
					    	$infoWeb = new InfoWeb();
    						$infoWeb->viandeSelected($_GET['libelleAnimal'], $_GET['libelleMorceau']); 
    					?>
				  </select><br>
				  Quantite :<br>
				  <input name="quantite" type="text" value=<?php echo $_GET['quantite'] ?>><br>
				  <input name="idCommande" value=<?php echo $_GET['idCommande'] ?> type="text" hidden>
				  
				  <input name="alterCommande" value="alterCommande" type="text" hidden>
				  <br><br>
				  <input type="submit" value="Ajouter">
			</form>   
  		</div>
	</div>
</div>
</body>
</html>