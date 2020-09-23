<?php 

require_once('../controller/dbase.php');
/**
 * 
 */
class Produit
{
	public $id;
	public $nom;
	
	
	function __construct()
	{
		# code...
	}

	function afficher_produits(){
		$connexion = new Connexion();
		$bdd = $connexion->GetConnexion();
		$resultat = $bdd->prepare("select * from t_produit");
		$resultat->execute(array());
		return $resultat->fetchAll();
	}

	function afficher_produits_fournisseur($id_fournisseur){
			$connexion = new Connexion();
		$bdd = $connexion->GetConnexion();
		$resultat = $bdd->prepare("
			select p.nom, p.id from t_produit p, t_fournisseur f, r_fournisseur_produit pf
				where pf.id_fournisseur = f.id
					and pf.id_produit = p.id
					and f.id = :f;
			");
		$resultat->execute(array("f"=>$id_fournisseur));
		return $resultat->fetchAll();	
	}
}

