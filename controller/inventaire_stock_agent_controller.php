<?php 
	require_once("../model/agent.class.php");
	extract($_POST);
	extract($_GET);
	$agent = new Agent();
	if(isset($inventaire_emoney)){
		$montant_restant = $montant_initial - $montant_operations;
		$res = $agent->enregistrer_inventaire_emoney($id_stock, $montant_operations, $montant_restant);
		header("Location:../choix_categorie_produit_agent.php");
	}
	if(isset($inventaire_unites)){
		try {
			$montant_restant = $montant_initial - $montant_operations;
			$quantite_restante = $quantite_initiale - $quantite_operations;
			// echo $quantite_initiale;
			// echo $quantite_operations;
			// echo $quantite_restante;
			$agent->enregistrer_inventaire_unites($id_stock, $montant_operations, $montant_restant, $quantite_operations, $quantite_restante);
			$inventaire = $agent->recuperer_infos_inventaire($id_agent, $id_categorie_produit);
			print_r($inventaire);

			$id_agent_produit = $inventaire[0]['id_agent_produit'];
			// $montant_initial = $inventaire[0]['montant_restant'];
			$id_type_unites = $inventaire[0]['id_type_unites'];
			$id_format_carte = $inventaire[0]['id_format_carte'];
			// $quantite_initiale = $inventaire[0]['quantite_restant'];

			$agent->enregistrer_unites_initiales($id_agent_produit, $montant_restant, $id_type_unites, $id_format_carte, $quantite_restante);

			
			header("Location:../vues/choix_categorie_produit_agent.php");
			
		} catch (Exception $e) {
			die($e->getMessage());
		}
		
	}
 ?>