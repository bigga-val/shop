<?php 
	extract($_GET);
	extract($_POST);

	require_once('../model/agent.class.php');
    $agent = new Agent();
    // $categories = $agent->afficher_categorie_produit_agent($id_agent);
    $agents = $agent->afficher_agents();
    // print_r($categories);
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Choisir la categorie de produit</title>
 	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css"/>
    <!-- <link rel="stylesheet" type="text/css" href="../assets/bootstrap.css"> -->
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css"/>
 </head>
 <body>
 	<?php include "navbar.php"; ?>
 	<div class="container-fluid">
 		<h2>Stock Agent</h2>
 		<div class="row">
 					<!-- <table class="table table-hover">
 						<thead>
 							<th>Categorie</th>
 							<th>Action</th>
 						</thead>
 						<tbody>
 							
 							<?php foreach($categories as $categ){ ?>
	 							<tr class="">
	 								<td> <a href=""><?php echo $categ['nom']; ?> </a></td>
	 								<td><a href="voir_stock_agent.php?id_agent=<?php echo $categ['id'] ?>">Voir</a></td>
	 							</tr>
	 						<?php } ?>	
 						</tbody>
 					</table> -->
 					<div class="col-md-4">
 						<div class="form-group">
 							<select class="form-control" name="agent" id="agent">
 								<option disabled selected hidden>Choisir un Agent</option>
	 							<?php foreach ($agents as $agent) {  ?>
	 								<option  value="<?php echo $agent['id'] ?>"><?php echo $agent['prenom'] ?></option>
	 							<?php } ?>
	 						</select>	
 						</div>
 					</div>
 					<div class="col-md-4" id="categories">
 						
 					</div>
 					<div class="col-md-4">
 						<button id="btn_voir_stock" class="btn btn-primary">voir</button>
 					</div>
 				
		</div>
		<div class="row">
			
			<div class="col-md-12"  id="tableau_stock">
				
				<div class="jumbotron">
					<h3>Aucune données à afficher</h3>
					<p>Veuillez sélectionner un agent et la categorie de produit à afficher</p>
				</div>	
			</div>
				
		</div>
	</div>
</div>
 	
 	<script type="text/javascript" src="../assets/js/jquery-3.3.1.min.js"></script>
 	<script type="text/javascript" src="../assets/js/ajax/tri_categorie_produit_agent.js"></script>
 	<script type="text/javascript" src="../assets/js/ajax/inventaire_stock_agent.js"></script>
 </body>
 </html>