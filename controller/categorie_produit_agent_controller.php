<?php 

require_once("../model/agent.class.php");
extract($_GET);
extract($_POST);

if(isset($agent)){
	$a = new Agent();
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
}

 