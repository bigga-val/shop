<?php 
    require_once('../modeles/connexion.class.php');
    require_once('../modeles/devise.class.php');
    require_once('../modeles/categorie.class.php');
    require_once('../modeles/produit.class.php');

    extract($_GET);
    extract($_POST);

    $cat = Categorie ::getCategorie();
    $dev = Devise::getDevise();
    $prod = Produit::getProduit();
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css"/>
    <!-- <link rel="stylesheet" type="text/css" href="../assets/bootstrap.css"> -->
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css"/>
    <title>Document</title>
</head>
<body>
   <?php include('navbar.php'); ?>
   <div class="row">
       <div class="col-md-6"></br>
         <h2 class="text-center">Money éléctronique</h2></br>
         <form action="" method="post">
             <select id="id" class="form-control mb-2 mr-sm-2">
                 <?php  
                      foreach($cat as $catt)
                      {
                 ?>
                      <option value="<?php echo $catt->id; ?>" class="col-sm-6 col-12">
                         <?php echo $catt->nom?>
                      </option>
                    <?php
                      } ?>
             </select>
             <select class="form-control mb-2 mr-sm-2">
                 <option>nom de l agent</option>
             </select>
             <select id="idProduit" class="form-control mb-2 mr-sm-2">
                 <?php foreach($prod as $pr)
                   {
                ?>
                   <option value="<?php echo $pr->idProduit ?>">
                        <?php echo $pr->nom ?>
                   </option>
                <?php
                   } ?>
             </select>
             <select class="form-control mb-2 mr-sm-2">
                 <option>cartes</option>
                 <option>flash</option>
             </select>
             <div class="form-group" class="sr-only">
                <input type="number" class="form-control mb-2 mr-sm-2"  name="" placeholder="quantité">
             </div>
             <div class="form-group" class="sr-only">
                <input type="number" class="form-control mb-2 mr-sm-2"  name="" placeholder="montant">
             </div>
             <select id="idDevise" class="form-control mb-2 mr-sm-2">
                 <?php 
                    foreach($dev as $devv)
                    {
                 ?>
                    <option value="<?php echo $devv->idDevise; ?>">
                    <?php echo $devv->nom_devise; ?>
                    </option>
                 <?php
                    }
                 ?>
             </select>
                <input type="submit" value="connexion" class="btn btn-outline-primary btn-block" >
                <input type="submit" value="Annuler" class="btn btn-outline-danger btn-block">
         </form>
       </div>
       <div class="col-md-6"></br>
           <h2 class="text-center">vente unités</h2></br>
           <form action="" method="post">
             <select class="form-control mb-2 mr-sm-2">
                 <option>nom de l agent</option>
             </select>
             <select class="form-control mb-2 mr-sm-2">
                 <option>type operation</option>
             </select>
             
             <div class="form-group" class="sr-only">
                <input type="number" class="form-control mb-2 mr-sm-2"  name="" placeholder="quantité">
             </div>
             <div class="form-group" class="sr-only">
                <input type="number" class="form-control mb-2 mr-sm-2"  name="" placeholder="montant">
             </div>
             <select class="form-control mb-2 mr-sm-2">
                 <option>cdf</option>
                 <option>usd</option>
             </select>
                <input type="submit" value="connexion" class="btn btn-outline-primary btn-block" >
                <input type="submit" value="Annuler" class="btn btn-outline-danger btn-block">
         </form>
       </div>
   </div>
        
</body>
</html>