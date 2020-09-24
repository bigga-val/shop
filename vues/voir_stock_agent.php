<?php 
	extract($_GET);
	extract($_POST);

	require_once('../model/agent.class.php');
    $agent = new Agent();
    // $agents = $agent->afficher_agents();
    $stocks = $agent-> afficher_stock_agent($id_agent);
    
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Voir le stock de l'agent</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css"/>
    <!-- <link rel="stylesheet" type="text/css" href="../assets/bootstrap.css"> -->
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css"/>
</head>
<body>
	<?php include "navbar.php"; ?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<table class="table table-hover">
					<thead class="bg-info text-white">
						<th>Date</th>
						<th>Produit</th>
						<th>Mont. Initial</th>
						<th>Mont. Opérations</th>
						<th>Mont. Restant</th>
						<th>Qté Initiale</th>
						<th>Qté Opérations</th>
						<th>Qté Restante</th>
						<th colspan="2" class="text-center">Actions</th>
					</thead>
					<tbody>
						<?php foreach ($stocks as $stock) {  ?>
						<tr>
							<td><?php echo $stock['date_stock']; ?></td>
							<td><?php echo $stock['nom']; ?></td>
							<td><?php echo $stock['montant_initial']; ?></td>
							<td><?php echo $stock['montant_operations']; ?></td>
							<td><?php echo $stock['montant_restant']; ?></td>
							<td><?php echo $stock['quantite_initiale']; ?></td>
							<td><?php echo $stock['quantite_operations']; ?></td>
							<td><?php echo $stock['quantite_restant']; ?></td>
							<td><a href="" class="btn btn-primary">Approvisionner</a></td>
							<td><a href="" class="btn btn-success">Inventaire</a></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>