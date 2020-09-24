<?php 

	require_once('../model/agent.class.php');
    $agent = new Agent();
    $agents = $agent->afficher_categorie_produit_agent($id_agent);
    print_r($agents);
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Choisir la categorie de produit</title>
 	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css"/>
    <!-- <link rel="stylesheet" type="text/css" href="../assets/bootstrap.css"> -->
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css"/>
 </head>
 <body>
 
 </body>
 </html>