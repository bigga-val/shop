<?php 

require_once('../controller/dbase.php');
/**
 * 
 */
class Fournisseur
{
	public $id;
	public $nom;
	public $postnom;
	
	function __construct()
	{
		# code...
	}

	function afficher_fournisseurs(){
		$connexion = new Connexion();
		$bdd = $connexion->GetConnexion();
		$resultat = $bdd->prepare("select * from t_fournisseur");
		$resultat->execute(array());
		return $resultat->fetchAll();
	}
}

