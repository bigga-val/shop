<?php

/**
  * 
  */
 class Connexion
 {
 	
 	

 	public function GetConnexion() {
        try {
            // On se connecte Ã  MySQL          

            $bdd = new PDO('mysql:host=localhost;dbname=prince_db', 'root', '');
            return $bdd;
        } catch (Exception $e) {
            
            die('Erreur : ' . $e->getMessage());

        }
    }
 } 
	
 ?>