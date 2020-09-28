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
    $info_agent = $agents->afficher_single_agent($id_agent);
    $nom_produit = $agents->afficher_nom_produit_from_agent_produit($stock['id_agent_produit']);
    // print_r($agents);
    // print_r($stock);
    // print_r($nom_produit);

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Approvisionnement Agent - Prince Shop</title>
 	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css"/>
    <!-- <link rel="stylesheet" type="text/css" href="../assets/bootstrap.css"> -->
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css"/>
 </head>
 <body>
 	<div class="container">
 		<div class="row">
 			<div class="col-md-4">
 				
 			</div>
 			<div class="col-md-4">
 				
 			</div>
 			<div class="col-md-4">
 				
 			</div>
 		</div>
 		<div class="row">
 			<div class="col-md-6">
 				<form method="post" action="../controller/approvision_agent_controller.php">
 					<div class="form-group">
 						<input type="number" class="form-control" name="montant" placeholder="montant">
 					</div>
 					<div class="form-group">
 						<input type="text" name="id_type_unites" value="<?php echo $id_type_unites ?>">
 						<input type="text" name="id_format_carte" value="<?php echo $id_format_carte ?>">
 						<input type="text" name="id_devise" value="<?php echo $id_devise ?>">
 						<input type="text" name="id_agent" value="<?php echo $id_agent ?>">
 						<input type="text" name="id_produit" value="<?php echo $id_produit ?>">
 						<input type="text" name="id_stock" value="<?php echo $id_stock ?>">
 					</div>
 					<div class="form-group">
 						<input type="number" class="form-control" name="quantite" placeholder="quantité">
 					</div>
 					<input type="submit" name="approvisionner" value="Enregistrer" class="btn btn-success">
 				</form>
 			</div>
 			<div class="col-md-6">
 				<div class="form-group">
 					
 				</div>
 			</div>
 		</div>
 	</div>
 </body>
 </html>