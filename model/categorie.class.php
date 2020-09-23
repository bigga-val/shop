<?php 

require_once('../controller/dbase.php');
/**
 * 
 */
class Categorie
{
	public $id;
	public $nom;
	
	
	function __construct()
	{
		# code...
	}

	function afficher_categories(){
		$connexion = new Connexion();
		$bdd = $connexion->GetConnexion();
		$resultat = $bdd->prepare("select * from t_categorie_produit");
		$resultat->execute(array());
		return $resultat->fetchAll();
	}
}

