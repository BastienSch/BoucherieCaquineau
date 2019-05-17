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
    		<h3 class="titre">Liste des viandes :</h3>
    	</div>

    </div>
    <br/>
    
    <a href="addViande.php" class="button-add button"><i class="fa fa-plus-circle add margin-right"></i>Ajouter une Viande</a><br><br>
    
  	<div class="row content">
	    <div class="column column-100 ">
	        <table >
			    <thead>
			        <tr>
			            <th>Id</th>
			            <th>Nom de l'animal</th>
			            <th>Nom du morceau</th>
			            <th>Modifier</th>
			            <th>Supprimer</th>
			        </tr>	
			    </thead>
			    <tbody>
			    	<?php 
			    		$infoWeb = new InfoWeb();
    					$infoWeb->viandeList();
			        ?>
			    </tbody>
			</table>
  		</div>
	</div>
</div>	
</body>
</html>
