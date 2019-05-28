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
				  <br>Nom de l'entreprise :<br>
				  <input name="nomEntreprise" type="text" value=<?php echo $_GET['nomEntreprise'] ?> ><br>
				  Rue :<br>
				  <input name="rue" type="text" value=<?php echo $_GET['rue'] ?>><br>
				  Ville :<br>
				  <input name="ville" type="text" value=<?php echo $_GET['ville'] ?>><br>
				  Numéro de téléphone :<br>
				  <input name="tel" type="text" value=<?php echo $_GET['tel'] ?>><br>
				  Adresse E-mail :<br>
				  <input name="mail" type="text" value=<?php echo $_GET['mail'] ?>><br>
				  Département :<br>
				  <select name="CP" >
					   <?php 
					    	$infoWeb = new InfoWeb();
    						$infoWeb->departementSelected($_GET['CP']); 
    					?>
				  </select>
				  Secteur d'activité :<br>
				  <select name="idSecteur">
					   <?php 
					    	$infoWeb = new InfoWeb();
    						$infoWeb->secteurSelected($_GET['libelle']); 
    					?>
				  </select>
				  <input name="idFournisseur" value=<?php echo $_GET['idFournisseur'] ?> type="text" hidden>
				  <input name="alterFournisseur" value="alterFournisseur" type="text" hidden>
				  <br><br>
				  <input type="submit" value="Ajouter">
			</form>   
  		</div>
	</div>
</div>
</body>
</html>