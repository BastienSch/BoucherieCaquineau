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
    		<h3 class="titre">Liste des Fournisseurs :</h3>
    	</div>
    </div>
    <br/>
    <a href="addFournisseur.php" class="button-add button"><i class="fa fa-plus-circle add margin-right"></i>Ajouter un fournisseur</a><br><br>
  	<div class="row content"> 
	    <div class="column column-100 ">
	        <table >
			    <thead>
			        <tr>
			            <th>Id</th>
			            <th>Nom de l'entreprise</th>
			            <th>Secteur d'activité</th>
			            <th>Adresse</th>
			            <th>Numéro</th>
			            <th>E-mail</th>
			            <th>Modifier</th>
			            <th>Supprimer</th>
			        </tr>	
			    </thead>
			    <tbody>
			    	<?php 
			    		$infoWeb = new InfoWeb();
    					$infoWeb->fournisseurList();
			        ?>
			    </tbody>
			</table>
  		</div>
	</div>
</div>
	
</body>
</html>

