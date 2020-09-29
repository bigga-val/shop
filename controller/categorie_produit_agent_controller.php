<?php 

require_once("../model/agent.class.php");
require_once("../model/type_unites.class.php");
extract($_GET);
extract($_POST);

$a = new Agent();

if(isset($agent)){
	
	$categories = $a->afficher_categorie_produit_agent($agent);
	// print_r($categories);
	$cat = " ";
	foreach($categories as $categ){ 
		$cat.='<div class="form-check-inline">';
		  $cat.='<label class="form-check-label">';
		    $cat.='<input type="radio" class="form-check-input"';
		    $cat.='value="'.$categ["id"] .'" name="categorie">'.$categ["nom"];
		  $cat.='</label>';
		$cat.='</div>';
	} 
	echo $cat;
	// echo $agent;
}elseif (isset($id_categorie) and isset($id_agent)) {
	if ($id_categorie == 1) {
		$stock_cartes = $a->afficher_stock_unites_carte_agent($id_agent, $id_categorie);
		$stock_flash = $a->afficher_stock_unites_flash_agent($id_agent, $id_categorie);
		$actions = "";
		$tableau ='<div style="width: 100%; height: 250px; overflow: scroll;" >';
		$tableau .='<h4>Unités Cartes</h4>';
		$tableau .= '<table class="table table-hover">
		 	<thead class="sticky-top table-primary">
		 		<th>Date</th>
		 		<th>Produit</th>
		 		<th>Mont. Init</th>
		 		<th>Mont. Operations</th>
		 		<th>Mont. Restant</th>
		 		<th>Type</th>
		 		<th>Format</th>
		 		<th>Qté Init</th>
		 		<th>Qté Operations</th>
		 		<th>Qté Restantes</th>
		 		<th>Actions</th>
		 	</thead>
		 	<tbody>';
		 	foreach ($stock_cartes as $stock) {
		 		if($stock["montant_restant"] == NULL){
		 			$actions = '<a href="inventaire_unites.php?categorie='.$id_categorie.'&agent='.$id_agent.'&id_stock='.$stock["id"].'">Inventaire</a> <a href="approvisionnement_agent.php?id_stock='.$stock["id"].'&id_agent='.$id_agent.'&id_produit='.$stock['produit'].'&id_type_unites='.$stock['id_type_unites'].'&id_format_carte='.$stock['id_format_carte'].'&id_devise='.$stock['id_devise'].'&nom_type='.$stock["nom_type"].'&prenom='.$stock["prenom"].'&nom_produit='.$stock["nom"].'">Approvisionner</a>';
		 		}else{
		 			$actions = '<span class="badge badge-secondary">Archive</span>';
		 		}
		 		$tableau.='<tr>';
		 			$tableau.='<td>'.$stock["date_stock"].'</td>';
		 			$tableau.='<td>'.$stock["nom"].'</td>';
		 			$tableau.='<td>'.$stock["montant_initial"].'</td>';
		 			$tableau.='<td>'.$stock["montant_operations"].'</td>';
		 			$tableau.='<td>'.$stock["montant_restant"].'</td>';
		 			$tableau.='<td>'.$stock["nom_type"].'</td>';
		 			$tableau.='<td>'.$stock["nom_format"].'</td>';
		 			$tableau.='<td>'.$stock["quantite_initiale"].'</td>';
		 			$tableau.='<td>'.$stock["quantite_operations"].'</td>';
		 			$tableau.='<td>'.$stock["quantite_restant"].'</td>';
		 			// $tableau.='<td>Inventaire</td>';
		 			$tableau.='<td>'.$actions.'</td>';
		 		$tableau.='</tr>';
		 	}
		 	$tableau.='</tbody>';
		 $tableau.='</table>';
		$tableau.='</div>';


// tableau de unités flash debut
		 $tableau .='<div style="width: 100%; height: 250px; overflow: scroll;" >';
		$tableau .='<h4>Unités Flash</h4>';
		$tableau .= '<table class="table table-hover">
		 	<thead class="sticky-top table-primary">
		 		<th>Date</th>
		 		<th>Produit</th>
		 		<th>Mont. Init</th>
		 		<th>Mont. Operations</th>
		 		<th>Mont. Restant</th>
		 		<th>Qté Initiale</th>
		 		<th>Qté Opérations</th>
		 		<th>Qté Restante</th>
		 		<th>Actions</th>
		 	</thead>
		 	<tbody>';
		 	foreach ($stock_flash as $stock) {
		 		if($stock["montant_restant"] == NULL){
		 			$actions = '<a href="inventaire_unites.php?categorie='.$id_categorie.'&agent='.$id_agent.'&id_stock='.$stock["id"].'">Inventaire</a> <a href="approvisionnement_agent.php?id_stock='.$stock["id"].'&id_agent='.$id_agent.'&id_produit='.$stock['produit'].'&id_type_unites='.$stock['id_type_unites'].'&id_format_carte='.$stock['id_format_carte'].'&id_devise='.$stock['id_devise'].'&nom_type='.$stock["nom_type"].'&prenom='.$stock["prenom"].'&nom_produit='.$stock["nom"].'">Approvisionner</a>';
		 		}else{
		 			$actions = '<span class="badge badge-secondary">Archive</span>';
		 		}
		 		$tableau.='<tr>';
		 			$tableau.='<td>'.$stock["date_stock"].'</td>';
		 			$tableau.='<td>'.$stock["nom"].'</td>';
		 			$tableau.='<td>'.$stock["montant_initial"].'</td>';
		 			$tableau.='<td>'.$stock["montant_operations"].'</td>';
		 			$tableau.='<td>'.$stock["montant_restant"].'</td>';
		 			$tableau.='<td>'.$stock["quantite_initiale"].'</td>';
		 			$tableau.='<td>'.$stock["montant_operations"].'</td>';
		 			$tableau.='<td>'.$stock["quantite_restant"].'</td>';
		 			// $tableau.='<td>Inventaire</td>';
		 			$tableau.='<td>'.$actions.'</td>';
		 		$tableau.='</tr>';
		 	}
		 	$tableau.='</tbody>';
		 $tableau.='</table>';
		 $tableau.='</div>';


// fin tableau unités flash




		echo $tableau;




	}elseif($id_categorie == 2){
		$stock_emoney = $a->afficher_stock_emoney_agent($id_agent, $id_categorie);
		$actions = "";
		$tableau = '<div style="width: 100%; height: 250px; overflow: scroll;" >';
		$tableau = '<table class="table table-hover">
		 	<thead>
		 		<th>Date</th>
		 		<th>Produit</th>
		 		<th>Montant Initial</th>
		 		<th>Montant Operations</th>
		 		<th>Montant Restant</th>
		 		<th>Actions</th>
		 	</thead>
		 	<tbody>';
		 	foreach ($stock_emoney as $stock) {
		 		if($stock["montant_restant"] == NULL){
		 			$actions = '<a href="inventaire_emoney.php?categorie='.$id_categorie.'&agent='.$id_agent.'&id_stock='.$stock["id"].'">Inventaire</a> <a href="approvisionnement_agent.php">Approvisionner</a>';
		 		}else{
		 			$actions = '<span class="badge badge-secondary">Archive</span>';
		 		}
		 		$tableau.='<tr>';
		 			$tableau.='<td>'.$stock["date_stock"].'</td>';
		 			$tableau.='<td>'.$stock["nom"].'</td>';
		 			$tableau.='<td>'.$stock["montant_initial"].'</td>';
		 			$tableau.='<td>'.$stock["montant_operations"].'</td>';
		 			$tableau.='<td>'.$stock["montant_restant"].'</td>';
		 			// $tableau.='<td>Inventaire</td>';
		 			$tableau.='<td>'.$actions.'</td>';
		 		$tableau.='</tr>';
		 	}
		 	$tableau.='</tbody>';
		 $tableau.='</table>';
		$tableau.='</div>';
		echo $tableau;
	}
}

 ?>
