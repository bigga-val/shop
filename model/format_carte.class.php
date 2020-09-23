<?php 

require_once('../controller/dbase.php');
/**
 * 
 */
class FormatCarte
{
	public $id;
	public $id_type_unites;
	public $nom;
	
	
	function __construct()
	{
		# code...
	}

	function afficher_format_cartes(){
		$connexion = new Connexion();
		$bdd = $connexion->GetConnexion();
		$resultat = $bdd->prepare("select * from t_format_carte");
		$resultat->execute(array());
		return $resultat->fetchAll();
	}

	function afficher_format_by_type($type_unites){
		$connexion = new Connexion();
		$bdd = $connexion->GetConnexion();
		$resultat = $bdd->prepare("select * from t_format_carte where id_type_unites = :t");
		$resultat->execute(array('t'=>$type_unites));
		return $resultat->fetchAll();	
	}
}

