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

	function afficher_stock_unites_carte_agent($id_agent, $id_categorie){
		$connexion = new Connexion();
		$bdd = $connexion->GetConnexion();
		if($id_categorie == 1){
			$resultat = $bdd->prepare("
				select st.id, st.date_stock , p.nom, a.prenom, st.montant_initial, st.montant_operations, st.montant_restant, 
					tu.nom_type, fc.nom_format,
					st.quantite_initiale, st.quantite_operations, st.quantite_restant,
					st.id_type_unites, st.id_format_carte, st.id_devise, p.id as produit
				from stock_agent st, t_produit p, t_agent a, t_agent_produit ap, t_categorie_produit cp,
					t_type_unites tu, t_format_carte fc
				where st.id_agent_produit = ap.id
					and a.id = ap.id_agent
					and p.id = ap.id_produit
					and p.id_categorie_produit = cp.id
					and st.id_type_unites = tu.id
					and st.id_format_carte = fc.id
					and a.id = :d 
				    and cp.id = :c
				    order by st.id desc
				");
			$resultat->execute(array('d'=>$id_agent, 'c'=>$id_categorie)) or print_r($resultat->errorInfo());
			return $resultat->fetchAll();		
		}
	}

	function afficher_stock_unites_flash_agent($id_agent, $id_categorie){
		$connexion = new Connexion();
		$bdd = $connexion->GetConnexion();
		if($id_categorie == 1){
			$resultat = $bdd->prepare("
				select st.id, st.id_agent_produit, a.prenom,  st.date_stock , p.nom, st.montant_initial, st.montant_operations, st.montant_restant, tu.nom_type,
					st.quantite_initiale, st.quantite_operations, st.quantite_restant,
					st.id_type_unites, st.id_format_carte, st.id_devise, p.id as produit
				from stock_agent st, t_produit p, t_agent a, t_agent_produit ap, t_categorie_produit cp, t_type_unites tu
							where st.id_agent_produit = ap.id
								and a.id = ap.id_agent
								and p.id = ap.id_produit
								and p.id_categorie_produit = cp.id
								and st.id_type_unites = tu.id
								and tu.nom_type = 'flash'
			                    and a.id = :d
			                    order by st.id desc;
				");
			$resultat->execute(array('d'=>$id_agent)) or print_r($resultat->errorInfo());
			return $resultat->fetchAll();		
		}
	}

	function afficher_stock_emoney_agent($id_agent, $id_categorie){
		$connexion = new Connexion();
		$bdd = $connexion->GetConnexion();
		$resultat = $bdd->prepare("
			select st.id, st.date_stock, p.nom, st.montant_initial, st.montant_operations, st.montant_restant, p.id as produit, st.id_devise, a.prenom
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

	function recuperer_infos_inventaire($id_agent, $id_categorie){
		$connexion = new Connexion();
		$bdd = $connexion->GetConnexion();
		$resultat = $bdd->prepare("
			select st.id_agent_produit, st.montant_restant, st.id_type_unites, st.id_format_carte, quantite_restant
			from stock_agent st, t_produit p, t_agent a, t_agent_produit ap, t_categorie_produit cp
			where st.date_stock = current_date - 1
				and st.id_agent_produit = ap.id
				and ap.id_produit = p.id
				and ap.id_agent = a.id
                and p.id_categorie_produit = cp.id
                and p.id_categorie_produit = :cp
				and a.id = :a
			");
		$resultat->execute(array('a'=>$id_agent, 'cp'=>$id_categorie))
				or print_r($resultat->errorInfo());
		return $resultat->fetchAll();
	}

	function enregistrer_unites_initiales($id_agent_produit, $montant_initial, $id_type_unites, $id_format_carte, $quantite_initiale){
		$connexion = new Connexion();
		$bdd = $connexion->GetConnexion();

		// calcul de la date du prochain jour 
		$jour = date("d");
        if(date("l") == "Sunday"){
            $jour = $jour + 2;
        }else{
            $jour = $jour + 1;
        }

        $annee = date("Y");
        $mois = date("m");
        $my_date = date($annee.'-'.$mois.'-'.$jour);

        if(date("l") != "Sunday"){
        	$resultat = $bdd->prepare("
				INSERT INTO stock_agent(date_stock, id_agent_produit, montant_initial, id_type_unites, id_format_carte, quantite_initiale)
					values(current_date + 1, :ap, :mi, :tu, :fc, :qi);
			");
        }else{
        	$resultat = $bdd->prepare("
				INSERT INTO stock_agent(date_stock, id_agent_produit, montant_initial, id_type_unites, id_format_carte, quantite_initiale)
					values(current_date + 1, :ap, :mi, :tu, :fc, :qi);
			");
        }

        	
			
		$etat = $resultat->execute(array('ap'=>$id_agent_produit, 'mi'=>$montant_initial, 'tu'=>$id_type_unites, 'fc'=>$id_format_carte, 'qi'=>$quantite_initiale))
				or print_r($resultat->errorInfo());
		return 	$etat;	
	}

	function afficher_single_agent_produit($id_agent, $id_produit){
		$connexion = new Connexion();
		$bdd = $connexion->GetConnexion();
		$resultat = $bdd->prepare("
			select ap.id id from t_agent_produit ap, t_produit p, t_agent a
			where ap.id_produit = p.id
				and ap.id_agent = a.id
				and ap.id_agent = :a
				and ap.id_produit = :p
			    ");
		$resultat->execute(array('p'=>$id_produit, 'a'=>$id_agent))
			or die(print_r($bdd->errorInfo()));
		return $resultat->fetch();		
	}

	function get_dernier_historique(){
		$connexion = new Connexion();
		$bdd = $connexion->GetConnexion();
		$resultat = $bdd->prepare("
			select max(id) id from t_historique_fournissement_agent;
			");
		$etat = $resultat->execute(array())
			 or print_r($resultat->errorInfo());
		return 	$etat;
	}																										


	function approvisionner_stock_agent($id_stock, $montant, $quantite, $id_historique_fournissement){
		$connexion = new Connexion();
		$bdd = $connexion->GetConnexion();

		$resultat = $bdd->prepare("
			update stock_agent set montant_initial = montant_initial + :m, quantite_initiale = quantite_initiale + :q, id_historique_fournissement = :h
			where id = :i
			");
		$etat = $resultat->execute(array('i'=>$id_stock, 'm'=>$montant, 'q'=>$quantite, 'h'=>$id_historique_fournissement))
			 or print_r($resultat->errorInfo());
		return 	$etat;	
	}

	function enregistrer_historique_approvisionnement_agent_unites_cartes($id_agent, $id_produit, $montant,  $quantite, $id_type_unites, $id_format_carte, $id_devise){
		$connexion = new Connexion();
		$bdd = $connexion->GetConnexion();
		
		$ap = $this->afficher_single_agent_produit($id_agent, $id_produit);
		$id_agent_produit = $ap['id'];
		$resultat = $bdd->prepare("
			INSERT into t_historique_fournissement_agent(date_fournissement, id_agent_produit, montant, quantite, id_type_unites, id_format_carte, id_devise)
				values(current_date, $id_agent_produit, :m, :q, :tu, :fc, :d);
			");
		$etat = $resultat->execute(array('m'=>$montant, 'q'=>$quantite, 'tu'=>$id_type_unites, 'fc'=>$id_format_carte, 'd'=>$id_devise)) or print_r($resultat->errorInfo());
		return 	$etat;		
	}	

	function enregistrer_historique_approvisionnement_agent_unites_flash($id_agent, $id_produit, $montant,  $quantite, $id_type_unites, $id_devise){
		$connexion = new Connexion();
		$bdd = $connexion->GetConnexion();
		
		$ap = $this->afficher_single_agent_produit($id_agent, $id_produit);
		$id_agent_produit = $ap['id'];
		$resultat = $bdd->prepare("
			INSERT into t_historique_fournissement_agent(date_fournissement, id_agent_produit, montant, quantite, id_type_unites, id_devise)
				values(current_date, $id_agent_produit, :m, :q, :tu, :d);
			");
		$etat = $resultat->execute(array('m'=>$montant, 'q'=>$quantite, 'tu'=>$id_type_unites, 'd'=>$id_devise)) or print_r($resultat->errorInfo());
		return 	$etat;		
	}

	function enregistrer_historique_approvisionnement_agent_emoney($id_agent, $id_produit, $montant, $id_devise){
		$connexion = new Connexion();
		$bdd = $connexion->GetConnexion();
		
		$ap = $this->afficher_single_agent_produit($id_agent, $id_produit);
		$id_agent_produit = $ap['id'];
		$resultat = $bdd->prepare("
			INSERT into t_historique_fournissement_agent(date_fournissement, id_agent_produit, montant, id_devise)
				values(current_date, $id_agent_produit, :m, :d);
			");
		$etat = $resultat->execute(array('m'=>$montant, 'd'=>$id_devise)) or print_r($resultat->errorInfo());
		return 	$etat;		
	}

}