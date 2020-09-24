<?php 


    require_once('../model/agent.class.php');
    $agent = new Agent();
    $agents = $agent->afficher_agents();
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Liste agents - Prince Shop</title>
 	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css"/>
    <!-- <link rel="stylesheet" type="text/css" href="../assets/bootstrap.css"> -->
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css"/>
 </head>
 <body>
 	<?php include "navbar.php" ?>
 	<div class="container">
 		<div class="row">
 			<div class="col-md-12">
 				<table class="table table-hover">
 					<thead>
 						<th>#</th>
 						<th>prenom</th>
 						<th>Actions</th>
 					</thead>
 					<tbody>
 						<?php $i = 1; foreach ($agents as $agent) { ?>
 							<tr>
 								<td><?php echo $i; ?></td>
 								<td><?php echo $agent['prenom'] ?></td>
 								<td><a href="choix_categorie_produit_agent.php?id_agent=<?php echo $agent['id'] ?>" class="btn btn-primary">Voir Stock</a></td>
 							</tr>
 						<?php  $i++; } ?>
 					</tbody>
 				</table>
 			</div>
 		</div>
 	</div>
 </body>
 </html>