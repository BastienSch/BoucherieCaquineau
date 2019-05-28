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
    		<h3 class="titre">Liste des Animaux :</h3>
    	</div>
    </div>
    <br/>
    <a href="addAnimal.php" class="button-add button"><i class="fa fa-plus-circle add margin-right"></i>Ajouter un Animal</a><br><br>
  	<div class="row content">  
	    <div class="column column-100 ">
	        <table >
			    <thead>
			        <tr>
			            <th>Id</th>
			            <th>Nom de l'animal</th>
			            <th>Supprimer</th>
			        </tr>	
			    </thead>
			    <tbody>
			    	<?php 
			    		$infoWeb = new InfoWeb();
    					$infoWeb->animauxList();
			        ?>
			    </tbody>
			</table>
  		</div>
	</div>
	<p><b>*Un Animal ne peut être supprimé si il est lié à une viande</b></p>
</div>
</body>
</html>