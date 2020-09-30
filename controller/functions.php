<?php 

require_once("dbase.php");



function var_clean($var){
	$var = trim($var);
	$var = stripslashes($var);
	$var = htmlspecialchars($var);
	return $var;
}

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
	$resultat->execute(array()) or die(print_r($bdd->errorInfo()));
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
	$resultat->execute(array()) or die(print_r($bdd->errorInfo()));
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
	$resultat->execute(array()) or die(print_r($bdd->errorInfo()));
	return $resultat->fetchAll();
}

function retirer_stock_gerant_unites_cartes($id_produit, $montant, $quantite, $id_type_unites, $id_format_carte){
	$connexion = new Connexion();
	$bdd = $connexion->GetConnexion();
	$resultat = $bdd->prepare("
		UPDATE stock_gerant set montant = montant - :m, quantite = quantite - :q
			WHERE id_produit = :p
				and id_type_unites = :t
				and id_format_carte = :f
		    ");
	$res = $resultat->execute(array('p'=>$id_produit, 'm'=>$montant, 'q'=>$quantite, 't'=>$id_type_unites, 'f'=>$id_format_carte))
		or die(print_r($resultat->errorInfo()));
	return $res;
}

function retirer_stock_gerant_unites_flash($id_produit, $montant, $quantite, $id_type_unites){
	$connexion = new Connexion();
	$bdd = $connexion->GetConnexion();
	$resultat = $bdd->prepare("
		UPDATE stock_gerant set montant = montant - :m, quantite = quantite - :q
			WHERE id_produit = :p
				and id_type_unites = :t
				and id_format_carte is NULL
		    ");
	$res = $resultat->execute(array('p'=>$id_produit, 'm'=>$montant, 'q'=>$quantite, 't'=>$id_type_unites))
		or die(print_r($resultat->errorInfo()));
	return $res;
}

function retirer_stock_gerant_emoney($id_produit, $montant){
	$connexion = new Connexion();
	$bdd = $connexion->GetConnexion();
	$resultat = $bdd->prepare("
		UPDATE stock_gerant set montant = montant - :m
			WHERE id_produit = :p
				and id_type_unites is NULL;
		    ");
	$res = $resultat->execute(array('p'=>$id_produit, 'm'=>$montant))
		or die(print_r($resultat->errorInfo()));
	return $res;
}

function get_single_stock_gerant_unites_cartes($id_produit, $id_type_unites, $id_format_carte){
	$connexion = new Connexion();
	$bdd = $connexion->GetConnexion();
	$resultat = $bdd->prepare("
		select sg.id, p.nom, sg.montant, tu.nom_type, fc.nom_format, sg.quantite
		from stock_gerant sg, t_produit p, t_type_unites tu, t_format_carte fc
		where sg.id_produit = p.id
			and sg.id_type_unites = tu.id
		    and tu.nom_type = 'cartes'
		    and sg.id_format_carte = fc.id
		    and sg.id_produit = :p
		    and sg.id_type_unites = :tu
		    and sg.id_format_carte = :fc
		    ");
	$resultat->execute(array('p'=>$id_produit, 'tu'=>$id_type_unites, 'fc'=>$id_format_carte)) 
		or die(print_r($bdd->errorInfo()));
	return $resultat->fetchAll();
}

function get_single_stock_gerant_unites_flash($id_produit, $id_type_unites){
	$connexion = new Connexion();
	$bdd = $connexion->GetConnexion();
	$resultat = $bdd->prepare("
		select sg.id, p.nom, sg.montant, tu.nom_type, sg.quantite
		from stock_gerant sg, t_produit p, t_type_unites tu
		where sg.id_produit = p.id
			and sg.id_type_unites = tu.id
		    and tu.nom_type = 'flash'
		    and sg.id_produit = :p
		    and sg.id_type_unites = :tu
		    ");
	$resultat->execute(array('p'=>$id_produit, 'tu'=>$id_type_unites)) 
		or die(print_r($bdd->errorInfo()));
	return $resultat->fetchAll();
}


function get_single_stock_gerant_emoney($id_produit){
	$connexion = new Connexion();
	$bdd = $connexion->GetConnexion();
	$resultat = $bdd->prepare("
		select sg.id, p.nom, sg.montant, sg.quantite
		from stock_gerant sg, t_produit p
		where sg.id_produit = p.id
		    and sg.id_produit = :p
		    ");
	$resultat->execute(array('p'=>$id_produit)) 
		or die(print_r($bdd->errorInfo()));
	return $resultat->fetchAll();
}