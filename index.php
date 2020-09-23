<?php 
	require_once('model/fournisseur.class.php');
	require_once('model/categorie.class.php');
	require_once('model/produit.class.php');
	require_once('model/format_carte.class.php');
	require_once('model/type_unites.class.php');
	require_once('model/devise.class.php');
	$form = new TypeUnites();
	// $fss = $fournisseur->afficher_fournisseurs();
	$devise = new Devise();
	$d = $fournisseur->afficher_devises();
	
	
	print_r($d);
 ?>