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
    require_once('../controller/functions.php');
    $agents = new Agent();
    $stock = $agents->afficher_single_stock_emoney($id_stock);
    $info_agent = $agents->afficher_single_agent($id_agent);
    
    if(!empty($id_format_carte) and isset($id_format_carte)){
        $produit_stock = get_single_stock_gerant_unites_cartes($id_produit, $id_type_unites, $id_format_carte);
    }elseif(isset($id_type_unites) and !empty($id_type_unites)){
        $produit_stock = get_single_stock_gerant_unites_flash($id_produit, $id_type_unites);
    }else{
        $produit_stock = get_single_stock_gerant_emoney($id_produit);
    }
    // var_dump($produit_stock);

    // $nom_produit = $agents->afficher_nom_produit_from_agent_produit($stock['id_agent_produit']);
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
    <?php include "navbar.php" ?>
 	<div class="container pt-3">
        <h2>Approvisionnement Agent</h2>
 		<div class="row">
 			<div class="col-md-4">
 				<h2>Agent: <?php echo $prenom; ?></h2>
 			</div>
 			<div class="col-md-4">
 				<h2>Produit: <?php echo $nom_produit.' '; 
                    if(isset($nom_type)){
                        echo $nom_type;
                    }else{echo '';} ?></h2>
 			</div>
 			<div class="col-md-4">
 				
 			</div>
 		</div>
 		<div class="row">
 			<div class="col-md-6">
 				<form method="post" action="../controller/approvision_agent_controller.php">
                    <div class="form-group">
                        <label>Montant disponible</label>
                        <input class="form-control" name="montant_disponible" id="montant_disponible" type="text" value="<?php echo $produit_stock[0]['montant'] ?>" disabled>
                    </div>
 					<div class="form-group">
                        <label>Entrez le montant à approvisionner</label>
 						<input type="number" class="form-control" name="montant" id="montant_retirable" placeholder="montant" required>
 					</div>
 					<div class="form-group">
 						<input type="text" name="id_type_unites" value="<?php echo isset($id_type_unites)?$id_type_unites:''; ?>" placeholder="Type id_type_unites">
 						<input type="hidden" name="id_format_carte" value="<?php echo $id_format_carte ?>" placeholder="id_format_carte">
 						<input type="hidden" name="id_devise" value="<?php echo $id_devise ?>" placeholder="devise">
 						<input type="hidden" name="id_agent" value="<?php echo $id_agent ?>" placeholder="id_agent">
 						<input type="hidden" name="id_produit" value="<?php echo $id_produit ?>" placeholder="id_produit">
 						<input type="hidden" name="id_stock" value="<?php echo $id_stock ?>" placeholder="id_stock">
                        <input type="hidden" name="nom_type" value="<?php echo $nom_type ?>" placeholder="nom_type">
 					</div>
 					
 					
 				
 			</div>
 			<div class="col-md-6">
                    <?php if(!isset($produit_stock[0]['quantite'])){ ?>
                        <div class="form-group">
                            <label></label><br>
                            <input type="submit" name="approvisionner" value="Enregistrer" class="btn btn-success mt-2">    
                        </div>
                        
                    <?php }else{ ?>
                        <div class="form-group">
                            <label>Quantite disponible</label>
                            <input type="text" class="form-control" name="" placeholder="quantité"  value="<?php echo $produit_stock[0]['quantite'] ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Entrez la quantité à approvisionner</label>
                            <input type="number" class="form-control" name="quantite" placeholder="quantité" required>
                        </div>    
                        <input type="submit" name="approvisionner" value="Enregistrer" class="btn btn-success">
                    <?php } ?>

 					
 				
                
                </form>
 			</div>
 		</div>
 	</div>
    <script type="text/javascript" src="../assets/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../assets/js/ajax/approvisionnement_agent.js"></script>
 </body>
 </html>