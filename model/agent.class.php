<?php 

require_once("../controller/dbase.php");
/**
 * 
 */
class Agent
{
	
	function __construct()
	{
		# code...
	}

	function afficher_agents(){
		$connexion = new Connexion();
		$bdd = $connexion->GetConnexion();
		$resultat = $bdd->prepare("
			SELECT * from t_agent where active = 1; 
			");
		$resultat->execute(array()) or print_r($resultat->errorInfo());
		return $resultat->fetch();
	}
}