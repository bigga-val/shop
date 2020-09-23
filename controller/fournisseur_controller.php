<?php 
	extract($_POST);
	extract($_GET);
	require_once("../model/produit.class.php");
	require_once("../model/type_unites.class.php");
	require_once("../model/format_carte.class.php");

	if(isset($fournisseur)){
		$produit = new Produit;
		$resultat = $produit->afficher_produits_fournisseur($fournisseur);
		$tab = array();
		$select = "";
		foreach ($resultat as $key) {
			array_push($tab, $key['nom']);
			$select.="<option value='".$key['id']."'>".$key['nom']."</option>";
		}
		print_r($select);
	}else if(isset($produit)){
		$typeUnite = new TypeUnites();
		$resultat = $typeUnite->afficher_unites_by_produit($produit);
		$select = "";
		if(count($resultat) != 0){
			foreach ($resultat as $key) {
				//array_push($tab, $key['nom_type']);
				$select.="<option value='".$key['id']."'>".$key['nom_type']."</option>";
			}
		print_r($select);
		}else{

		}
	}else if(isset($typeunites)){
		$formatCarte = new FormatCarte();
		$resultat = $formatCarte->afficher_format_by_type($typeunites);
		$select = "";
		if(count($resultat) != 0){
			foreach ($resultat as $key) {
				// array_push($tab, $key['nom_format']);
				$select.="<option value='".$key['id']."'>".$key['nom_format']."</option>";
			}
		}

		print_r($select);
		
	}
 ?>
