<?php 

session_start();
if(empty($_SESSION['login']) or !isset($_SESSION['login'])){
    session_destroy();
    unset($_SESSION);
    header("Location:../");
}else{
    // print_r($_SESSION);
    
}

require_once("../controller/functions.php");
$unites_flash = get_stock_gerant_unites_flash();
// print_r($unites_flash);
$unites_cartes = get_stock_gerant_unites_cartes();
// print_r($unites_cartes);
$emoney = get_stock_gerant_emoney();
// print_r($emoney);
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Stock Gérant - Prince Shop</title>
 	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css"/>
    <!-- <link rel="stylesheet" type="text/css" href="../assets/bootstrap.css"> -->
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css"/>
 </head>
 <body>
 	<?php include "navbar.php" ?>
 	<div class="container">
 		<h2>Stock du Gérant</h2>
 		<p>Unités Flash</p>
 		<div class="row">
 			<div class="col-md-12">
 				<table class="table table-hover">
 					<thead>
 						<th>N°</th>
 						<th>Produit</th>
 						<th>Montant</th>
 						<th>Format</th>
 						<th>Quantité</th>
 						<th>Actions</th>
 					</thead>
 					<tbody>
 						<?php $i = 1;foreach ($unites_cartes as $unites) { ?>
 							<tr>
 								<td><?php echo $i ?></td>
 								<td><?php echo $unites['nom'] ?></td>
 								<td><?php echo $unites['montant'] ?></td>
 								<td><?php echo $unites['nom_format'] ?></td>
 								<td><?php echo $unites['quantite'] ?></td>
 								<td><a href="index.php">Approvisionner</a></td>
 							</tr>
 						<?php $i++; } ?>
 					</tbody>
 				</table>
 			</div>
 		</div>

 		Stock Gérant : Unités Flash
 		<div class="row">
 			<div class="col-md-12">
 				<table class="table table-hover">
 					<thead>
 						<th>N°</th>
 						<th>Produit</th>
 						<th>Montant</th>
 						<th>Quantité</th>
 						<th>Actions</th>
 					</thead>
 					<tbody>
 						<?php $i = 1;foreach ($unites_flash as $unites) { ?>
 							<tr>
 								<td><?php echo $i ?></td>
 								<td><?php echo $unites['nom'] ?></td>
 								<td><?php echo $unites['montant'] ?></td>
 								<td><?php echo $unites['quantite'] ?></td>
 								<td><a href="index.php">Approvisionner</a></td>
 							</tr>
 						<?php $i++; } ?>
 					</tbody>
 				</table>
 			</div>
 		</div>

 		Stock Gérant : Emoney
 		<div class="row">
 			<div class="col-md-12">
 				<table class="table table-hover">
 					<thead>
 						<th>N°</th>
 						<th>Produit</th>
 						<th>Montant</th>
 						<th>actions</th>
 					</thead>
 					<tbody>
 						<?php $i = 1;foreach ($emoney as $money) { ?>
 							<tr>
 								<td><?php echo $i ?></td>
 								<td><?php echo $money['nom'] ?></td>
 								<td><?php echo $money['montant'] ?></td>
 								<td><a href="index.php">Approvisionner</a></td>
 							</tr>
 						<?php $i++; } ?>
 					</tbody>
 				</table>
 			</div>
 		</div>
 	</div>
 	<script type="text/javascript" src="../assets/js/jquery-3.3.1.min.js"></script>
 </body>
 </html>