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

	function afficher_derniers_fournissemens(){
		$connexion = new Connexion();
		$bdd = $connexion->GetConnexion();
		$resultat = $bdd->prepare("
			select of.date_fournissement, f.nom fournisseur, of.montant, of.quantite_produit, p.nom, d.nom_devise 
			from t_operation_fournisseur of, t_produit p, devise d, t_fournisseur f
			where of.id_produit = p.id
				and of.id_devise = d.id
				and of.id_fournisseur = f.id
				order by of.id DESC LIMIT 5;
			");
		$resultat->execute(array());
		return $resultat->fetchAll();
	}
}

