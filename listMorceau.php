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
    		<h3 class="titre">Liste des morceaux de viande :</h3>
    	</div>

    </div>
    <br/>
    <a href="addMorceau.php" class="button-add button"><i class="fa fa-plus-circle add margin-right"></i>Ajouter un morceau</a><br><br>
  	<div class="row content">
	    <div class="column column-100 ">
	        <table >
			    <thead>
			        <tr>
			            <th>Id</th>
			            <th>Nom du morceau</th>
			            <th>Supprimer</th>
			        </tr>	
			    </thead>
			    <tbody>
			    	<?php 
			    		$infoWeb = new InfoWeb();
    					$infoWeb->morceauList();
			        ?>
			    </tbody>
			</table>
  		</div>
	</div>
	<p><b>*Un morceau de viande ne peut être supprimé si il est lié à une viande</b></p>

</div>	
</body>
</html>