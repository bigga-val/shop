<?php 

extract($_GET);
extract($_POST);
require_once("dbase.php");

if(isset($form_fournisseur)){
	try {
		echo $fournisseur;
		echo $produit;
		echo $quantite;
		echo $montant;
		$type_unites = isset($type_unites)? $type_unites: NULL;
		$format_carte = isset($format_carte)? $format_carte: NULL;
		// echo $devise;
		// echo $type_unites;
		// echo $format_carte;
		
		$con = new Connexion();
		$bdd = $con->GetConnexion();
		$res = $bdd->prepare("
			 INSERT INTO t_operation_fournisseur(
			 	id_fournisseur, id_produit, quantite_produit, montant, date_fournissement, id_devise, id_type_unites, id_format_carte) values(:f, :p, :q, :m, CURRENT_DATE, :d, :t, :c);
			");
		$res->execute(array('f'=>$fournisseur, 'p'=>$produit, 'q'=>$quantite, 'm'=>$montant, 'd'=>$devise, 't'=>$type_unites, 'c'=>$format_carte)) or die(print_r($res->errorInfo()));

		$res = $bdd->prepare("
			update stock_gerant set montant = montant + :m, quantite = quantite + :q
			where id_produit = :p 
				and id_type_unites = :t
				and id_format_carte = :f
			");
		$res->execute(array('p'=>$produit, 'm'=>$montant, 'q'=>$quantite, 't'=>$type_unites, 'f'=>$format_carte));
		
		header("Location:../vues/stockgerant.php");
	// INSERT INTO t_operation_fournisseur(
	// 			id_fournisseur, id_produit, quantite_produit, montant, date_fournissement, id_devise, id_type_unites, id_format_carte) values(2, 6, 96, 76800, CURRENT_DATE, 2, 1, 1);
		
	} catch (Exception $e) {
		
	}
	
}
else{
	echo "rien";
}