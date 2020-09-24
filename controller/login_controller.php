<?php 
	require_once("dbase.php");
	extract($_POST);
	extract($_GET);

	if(isset($email) and !empty($email) and isset($password) and !empty($password)){
		$connexion = new Connexion();
		$bdd = $connexion->GetConnexion();
		$resultat = $bdd->prepare("SELECT * from utilisateur where email = :e and password = :pw LIMIT 1");
		$resultat->execute(array('e'=>$email, 'pw'=>$password)) or die($resultat->errorInfo());
		
		while($user = $resultat->fetch()){
			session_start();
			$_SESSION['login']=$user["login"];
			$_SESSION['email']=$user["email"];
			echo $_SESSION['login'];
			$resultat->fetch();
		}
		if(isset($_SESSION['login']) and !empty($_SESSION['login'])){
			header("Location:../vues/");
		}else{
			header("Location:deconnexion.php");
		}
	}else{
		header("Location:deconnexion.php");
	}


 ?>