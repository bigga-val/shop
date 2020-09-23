<?php 

	require_once('../controller/dbase.php');
/**
 * 
 */
class Devise
{
	public $id;
	public $nom;
	
	function __construct()
	{
		# code...
	}

	function afficher_devises(){
		$connexion = new Connexion();
		$bdd = $connexion->GetConnexion();
		$resultat = $bdd->prepare("select * from devise");
		$resultat->execute(array());
		return $resultat->fetchAll();
	}
}