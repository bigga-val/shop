<?php 

require_once("dbase.php");



function get_stock_gerant_unites_cartes(){
	$connexion = new Connexion();
	$bdd = $connexion->GetConnexion();
	$resultat = $bdd->prepare("
		select sg.id, p.nom, sg.montant, tu.nom_type, fc.nom_format, sg.quantite
		from stock_gerant sg, t_produit p, t_type_unites tu, t_format_carte fc
		where sg.id_produit = p.id
			and sg.id_type_unites = tu.id
		    and tu.nom_type = 'cartes'
		    and sg.id_format_carte = fc.id
		    ");
	$resultat->execute(array()) or die(print_r($bdd->errorMessage()));
	return $resultat->fetchAll();
}


function get_stock_gerant_unites_flash(){
	$connexion = new Connexion();
	$bdd = $connexion->GetConnexion();
	$resultat = $bdd->prepare("
		select sg.id, p.nom, sg.montant, tu.nom_type, sg.quantite
		from stock_gerant sg, t_produit p, t_type_unites tu
		where sg.id_produit = p.id
			and sg.id_type_unites = tu.id
		    and tu.nom_type = 'flash'

		    ");
	$resultat->execute(array()) or die(print_r($bdd->errorMessage()));
	return $resultat->fetchAll();
}


function get_stock_gerant_emoney(){
	$connexion = new Connexion();
	$bdd = $connexion->GetConnexion();
	$resultat = $bdd->prepare("
		select sg.id, p.nom, sg.montant, sg.quantite
		from stock_gerant sg, t_produit p
		where sg.id_produit = p.id
			and p.id_categorie_produit = 2
		    ");
	$resultat->execute(array()) or die(print_r($bdd->errorMessage()));
	return $resultat->fetchAll();
}