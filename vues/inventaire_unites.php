<?php 

	session_start();
    if(empty($_SESSION['login']) or !isset($_SESSION['login'])){
        session_destroy();
        unset($_SESSION);
        header("Location:../");
    }else{
        // print_r($_SESSION);
        
    }

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
 		<form method="post" action="../controller/inventaire_stock_agent_controller.php">
 		<div class="row">

 			<div class="col-md-6">
 				
 					<div class="form-group">
 						<label>Montant Initial</label>
 						<input class="form-control" id="montant_initial" value="<?php echo $stock['montant_initial'] ?>" name="montant_initial" disabled>
 						<input type="hidden" name="inventaire_unites">
 						<input type="hidden" name="id_stock" value="<?php echo($id_stock) ?>">
 						<input type="hidden" value="<?php echo $stock['montant_initial'] ?>" name="montant_initial">
 					</div>
 					<div class="form-group">
 						<label>Montant Opérations</label>
 						<input type="number" name="montant_operations" class="form-control" id="montant_operations" value="" placeholder="Entrez le montant après les opérations" required>
 					</div>
 					<div class="form-group">
 						<label>Montant Restant</label>
 						<input type="text" name="montant_restant" class="form-control" id="montant_restant" value="" placeholder="Montant restant" disabled>
 					</div>
 					<input type="text" name="id_agent" value="<?php echo $info_agent['id'] ?>">
 					<input type="text" name="id_categorie_produit" value="<?php echo $categorie ?>">
 					

 				
 			</div>
 			<div class="col-md-6">
 				<div class="form-group">
 					<label>Quantité initiale</label>
 					<input class="form-control" type="text" value="<?php echo $stock['quantite_initiale'] ?>" name="" id="quantite_initiale" disabled>
 					<input class="form-control" type="hidden" value="<?php echo $stock['quantite_initiale'] ?>" name="quantite_initiale" id="quantite_initiale">
 				</div>	
 				<div class="form-group">
 					<label>Quantité Opérations</label>
 					<input class="form-control" type="number" name="quantite_operations" id="quantite_operations" placeholder="Entrez la quantité de cartes restantes" required>
 				</div>	
 				<div class="form-group">
 					<label>Quantité Restante</label>
 					<input class="form-control" type="text" name="quantite_restante" id="quantite_restante" disabled="">
 				</div>	
 				<input type="submit" class="btn btn-success" value="Enregistrer">
 			</div>
 			
 		</div>
 		</form>
 	</div>
 	<script type="text/javascript" src="../assets/js/jquery-3.3.1.min.js"></script>
 	<script type="text/javascript" src="../assets/js/ajax/inventaire_stock_agent.js"></script>
 </body>
 </html>