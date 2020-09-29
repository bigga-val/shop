<?php 

extract($_GET);
extract($_POST);

require_once("functions.php");
require_once("../model/agent.class.php");

if(isset($id_type_unites) and isset($id_format_carte) and !empty($id_format_carte) and !empty($id_type_unites) and $nom_type == "cartes"){
	try {
		$id_format_carte = var_clean($id_format_carte);
		$id_type_unites = var_clean($id_type_unites);
		$id_devise = var_clean($id_devise);
		$id_stock = var_clean($id_stock);
		$id_agent = var_clean($id_agent);
		$id_produit = var_clean($id_produit);
		$montant = var_clean($montant);
		$quantite = var_clean($quantite);

		$agent = new Agent();

		echo $id_format_carte;
		echo $id_type_unites;
		echo $id_devise;
		echo $id_stock;
		echo $id_agent;
		echo $id_produit;
		echo $montant;
		echo $quantite;
		$save = $agent->enregistrer_historique_approvisionnement_agent_unites_cartes($id_agent, $id_produit, $montant,  $quantite, $id_type_unites, $id_format_carte, $id_devise);
		echo $save;
		$substract = retirer_stock_gerant_unites_cartes($id_produit, $montant, $quantite, $id_type_unites, $id_format_carte);
		echo $substract;
		$dernier_historique = $agent->get_dernier_historique();

		$id_historique_fournissement = $dernier_historique['id'];

		$agent->approvisionner_stock_agent($id_stock, $montant, $quantite, $id_historique_fournissement);

		echo "bien";	
	} catch (Exception $e) {
		
	}
}else if(isset($id_type_unites) and(!empty($id_type_unites)) and ($nom_type == "flash")){

	try {
		$id_type_unites = var_clean($id_type_unites);
		$id_devise = var_clean($id_devise);
		$id_stock = var_clean($id_stock);
		$id_agent = var_clean($id_agent);
		$id_produit = var_clean($id_produit);
		$montant = var_clean($montant);
		$quantite = var_clean($quantite);

		// echo $quantite;
		// echo $montant;
		// echo $id_devise;
		$agent = new Agent();
		$save = $agent->enregistrer_historique_approvisionnement_agent_unites_flash($id_agent, $id_produit, $montant,  $quantite, $id_type_unites, $id_devise);
		echo $save;
		$substract = retirer_stock_gerant_unites_flash($id_produit, $montant, $quantite, $id_type_unites);
		echo $substract;
		$dernier_historique = $agent->get_dernier_historique();

		$id_historique_fournissement = $dernier_historique['id'];

		$agent->approvisionner_stock_agent($id_stock, $montant, $quantite, $id_historique_fournissement);
		
	} catch (Exception $e) {
		
	}
		
}