<?php 

require_once('../controller/dbase.php');
/**
 * 
 */
class TypeUnites
{
	public $id;
	public $id_produit;
	public $nom;
	
	
	function __construct()
	{
		# code...
	}

	function afficher_types_unites(){
		$connexion = new Connexion();
		$bdd = $connexion->GetConnexion();
		$resultat = $bdd->prepare("select * from t_type_unites");
		$resultat->execute(array());
		return $resultat->fetchAll();
	}

	function afficher_unites_by_produit($produit){
		$connexion = new Connexion();
		$bdd = $connexion->GetConnexion();
		$resultat = $bdd->prepare("select * from t_type_unites where id_produit = :p");
		$resultat->execute(array('p'=>$produit));
		return $resultat->fetchAll();	
	}
}

