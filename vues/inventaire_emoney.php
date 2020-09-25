<?php 

	extract($_POST);
	extract($_GET);

	require_once('../model/agent.class.php');
    $agents = new Agent();
    $stock = $agents->afficher_single_stock_emoney($id_stock);
    $info_agent = $agents->afficher_single_agent($agent);
    $nom_produit = $agents->afficher_nom_produit_from_agent_produit($stock['id_agent_produit']);


 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Inventaire Monnaie electronique</title>
 	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css"/>
    <!-- <link rel="stylesheet" type="text/css" href="../assets/bootstrap.css"> -->
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css"/>
 </head>
 <body>
 	<div class="container">
 		<h2><?php echo $info_agent['prenom'].' : '.$nom_produit['nom']; ?></h2>
 		<p>Inventaire du <?php echo $stock['date_stock']; ?></p>
 		<div class="row">
 			<div class="col-md-12">
 				<form method="post" action="../controller/inventaire_stock_agent_controller.php">
 					<div class="form-group">
 						<label>Montant Initial</label>
 						<input class="form-control" id="montant_initial" value="<?php echo $stock['montant_initial'] ?>" name="montant_initial" disabled>
 						<input type="hidden" name="inventaire_emoney">
 						<input type="hidden" name="id_stock" value="<?php echo($id_stock) ?>">
 						<input type="hidden" value="<?php echo $stock['montant_initial'] ?>" name="montant_initial">
 					</div>
 					<div class="form-group">
 						<label>Montant Opérations</label>
 						<input type="number" name="montant_operations" class="form-control" id="montant_operations" value="" placeholder="Entrez le montant après les opérations">
 					</div>
 					<div class="form-group">
 						<label>Montant Restant</label>
 						<input type="number" name="montant_restant" class="form-control" id="montant_restant" value="" placeholder="Montant restant" disabled>
 					</div>
 					<input type="submit" class="btn btn-success" value="Enregistrer">

 				</form>
 			</div>
 		</div>
 	</div>
 	<script type="text/javascript" src="../assets/js/jquery-3.3.1.min.js"></script>
 	<script type="text/javascript" src="../assets/js/ajax/Inventaire_stock_agent.js"></script>
 </body>
 </html>