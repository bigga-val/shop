<?php 
	require_once("../model/agent.class.php");
	extract($_POST);
	extract($_GET);

	if(isset($inventaire_emoney)){
		$montant_restant = $montant_initial - $montant_operations;
		$agent = new Agent();
		$res = $agent->enregistrer_inventaire_emoney($id_stock, $montant_operations, $montant_restant);
		header("Location:choix_categorie_produit_agent.php&")

	}
 ?>