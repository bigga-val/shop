<?php 
	require_once("../model/agent.class.php");
	extract($_POST);
	extract($_GET);
	$agent = new Agent();
	if(isset($inventaire_emoney)){
		$montant_restant = $montant_initial - $montant_operations;
		$res = $agent->enregistrer_inventaire_emoney($id_stock, $montant_operations, $montant_restant);
		header("Location:choix_categorie_produit_agent.php");
	}
	if(isset($inventaire_unites)){
		$montant_restant = $montant_initial - $montant_operations;
		$quantite_restante = $quantite_initiale - $quantite_operations;
		// echo $quantite_initiale;
		// echo $quantite_operations;
		// echo $quantite_restante;
		$res = $agent->enregistrer_inventaire_unites($id_stock, $montant_operations, $montant_restant, $quantite_operations, $quantite_restante);
		echo $res;
		// header("Location:../vues/choix_categorie_produit_agent.php");
	}
 ?>