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

	function afficher_stock_unites_agent($id_agent, $id_categorie){
		$connexion = new Connexion();
		$bdd = $connexion->GetConnexion();
		if($id_categorie == 1){
			$resultat = $bdd->prepare("
				select st.id, st.date_stock , p.nom, st.montant_initial, st.montant_operations, st.montant_restant, 
					tu.nom_type, fc.nom_format,
					st.quantite_initiale, st.quantite_operations, st.quantite_restant
				from stock_agent st, t_produit p, t_agent a, t_agent_produit ap, t_categorie_produit cp,
					t_type_unites tu, t_format_carte fc
				where st.id_agent_produit = ap.id
					and a.id = ap.id_agent
					and p.id = ap.id_produit
					and p.id_categorie_produit = cp.id
					and st.id_type_unites = tu.id
					and st.id_format_carte = fc.id
					and a.id = :d 
				    and cp.id = :c;
				");
			$resultat->execute(array('d'=>$id_agent, 'c'=>$id_categorie)) or print_r($resultat->errorInfo());
			return $resultat->fetchAll();		
		}
	}

	function afficher_stock_emoney_agent($id_agent, $id_categorie){
		$connexion = new Connexion();
		$bdd = $connexion->GetConnexion();
		$resultat = $bdd->prepare("
			select st.id, st.date_stock, p.nom, st.montant_initial, st.montant_operations, st.montant_restant
			from stock_agent st, t_produit p, t_agent a, t_agent_produit ap, t_categorie_produit cp
			where st.id_agent_produit = ap.id
				and a.id = ap.id_agent
				and p.id = ap.id_produit
                and p.id_categorie_produit = cp.id
				and a.id = :d 
                and cp.id = :c;
			");
		$resultat->execute(array('d'=>$id_agent, 'c'=>$id_categorie))
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

	function afficher_single_stock_emoney($id){
		$connexion = new Connexion();
		$bdd = $connexion->GetConnexion();
		$resultat = $bdd->prepare("
			select * from stock_agent where id = :d;
			");
		$resultat->execute(array('d'=>$id))
			 or print_r($resultat->errorInfo());
		return $resultat->fetch();			
	}
	function afficher_single_agent($id){
		$connexion = new Connexion();
		$bdd = $connexion->GetConnexion();
		$resultat = $bdd->prepare("
			select * from t_agent where id = :d;
			");
		$resultat->execute(array('d'=>$id))
			 or print_r($resultat->errorInfo());
		return $resultat->fetch();				
	}

	function afficher_nom_produit_from_agent_produit($id_agent_produit){
		$connexion = new Connexion();
		$bdd = $connexion->GetConnexion();
		$resultat = $bdd->prepare("
			select p.nom from t_produit p, t_agent_produit ap, stock_agent st
			where p.id = ap.id_produit
				and st.id_agent_produit = ap.id
			    and st.id_agent_produit = :ag
			");
		$resultat->execute(array('ag'=>$id_agent_produit))
			 or print_r($resultat->errorInfo());
		return $resultat->fetch();					
	}

	function enregistrer_inventaire_emoney($id_stock, $montant_operations, $montant_restant){
		$connexion = new Connexion();
		$bdd = $connexion->GetConnexion();
		$resultat = $bdd->prepare("
			update stock_agent set montant_operations = :mo, montant_restant = :mr
			where id = :i
			");
		$etat = $resultat->execute(array('i'=>$id_stock, 'mo'=>$montant_operations, 'mr'=>$montant_restant))
			 or print_r($resultat->errorInfo());
		return 	$etat;
	}

	function enregistrer_inventaire_unites($id_stock, $montant_operations, $montant_restant, $quantite_operations, $quantite_restante){
		$connexion = new Connexion();
		$bdd = $connexion->GetConnexion();
		$resultat = $bdd->prepare("
			update stock_agent set 
				montant_operations = :mo, montant_restant = :mr,
				quantite_operations = :qo, quantite_restant = :qr
			where id = :i
			");
		$etat = $resultat->execute(array('i'=>$id_stock, 'mo'=>$montant_operations, 'mr'=>$montant_restant, 'qo'=>$quantite_operations, 'qr'=>$quantite_restante))
				or print_r($resultat->errorInfo());
		return 	$etat;
	}

	function enregistrer_unites_initial(){
		$connexion = new Connexion();
		$bdd = $connexion->GetConnexion();
		$resultat = $bdd->prepare("
			
			");
		$etat = $resultat->execute(array('i'=>$id_stock, 'mo'=>$montant_operations, 'mr'=>$montant_restant, 'qo'=>$quantite_operations, 'qr'=>$quantite_restante))
				or print_r($resultat->errorInfo());
		return 	$etat;	
	}

}