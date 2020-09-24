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
		return $resultat->fetchAll();
	}

	function afficher_stock_agent($id){
		$connexion = new Connexion();
		$bdd = $connexion->GetConnexion();
		$resultat = $bdd->prepare("
			select st.date_stock, p.nom, st.montant_initial, st.montant_operations, st.montant_restant,
				st.quantite_initiale, st.quantite_operations, st.quantite_restant
			from stock_agent st, t_produit p, t_agent a, t_agent_produit ap
			where st.id_agent_produit = ap.id
				and a.id = ap.id_agent
				and p.id = ap.id_produit
				and a.id = :d ;
			");
		$resultat->execute(array('d'=>$id))
			 or print_r($resultat->errorInfo());
		return $resultat->fetchAll();	
	}

	function afficher_categorie_produit_agent($id){
		$connexion = new Connexion();
		$bdd = $connexion->GetConnexion();
		$resultat = $bdd->prepare("
			select a.prenom, pc.id, pc.nom from t_categorie_produit pc, t_produit p, t_agent_produit ap, t_agent a
			where pc.id = p.id_categorie_produit
				and p.id = ap.id_produit
				and a.id = ap.id_agent
				and a.id = :d
				GROUP BY pc.id;
			");
		$resultat->execute(array('d'=>$id))
			 or print_r($resultat->errorInfo());
		return $resultat->fetchAll();		
	}
}