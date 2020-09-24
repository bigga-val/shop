<?php 
	extract($_GET);
	extract($_POST);

	require_once('../model/agent.class.php');
    $agent = new Agent();
    $categories = $agent->afficher_categorie_produit_agent($id_agent);
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
 	<div class="container">
 		<div class="row">
 			<div class="col-sm-12">
 				<div>
 					<table class="table table-hover">
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
 					</table>
 				</div>
 			</div>
 		</div>
 	</div>
 </body>
 </html>