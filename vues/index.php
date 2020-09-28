<?php 
    
    session_start();
    if(empty($_SESSION['login']) or !isset($_SESSION['login'])){
        session_destroy();
        unset($_SESSION);
        header("Location:../");
    }else{
        // print_r($_SESSION);
        
    }
    
    require_once('../model/fournisseur.class.php');
    require_once('../model/categorie.class.php');
    require_once('../model/produit.class.php');
    require_once('../model/format_carte.class.php');
    require_once('../model/type_unites.class.php');
    require_once('../model/devise.class.php');
    
    
    $fournisseur = new Fournisseur();
    $fournisseurs = $fournisseur->afficher_fournisseurs();
    $devise = new Devise();
    $devises = $devise->afficher_devises();
    $derniers_fournissements = $fournisseur->afficher_derniers_fournissemens();
    // print_r($derniers_fournissements[0]);
    $typeUnites = new TypeUnites();

    $formatCarte = new FormatCarte();
    $formats = $formatCarte->afficher_format_cartes();
    $types = $typeUnites->afficher_types_unites();
    // print_r($types);
    $types_tab = array();
    $formats_tab = array();
    $liste = "";
    foreach ($types as $type) {
        array_push($types_tab, $type['id_produit']);
    }

    foreach ($formats as $format) {
        array_push($formats_tab, $format);
    }
    for($i = 0; $i < count($formats_tab); $i++){
        // echo $formats_tab[$i]['id_type_unites'];
        $liste.= $formats_tab[$i]['id_type_unites'].";";
    }
    


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css"/>
    <!-- <link rel="stylesheet" type="text/css" href="../assets/bootstrap.css"> -->
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css"/>
    <title>Prince shop</title>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container">
    <div class="row p-0">
        <h2 class="text-center">Approvisionnement</h2>
    </div>
    <div class="row pb-4">
        <div class="col-md-6 pt-5">
        <!-- input qui fournit les produits cartes ou flash au fichier js -->
        <input type="hidden" name="" value="<?php echo $liste ?>" id="tableau_cartes">            

          <form action="../controller/produit_fournisseur_controller.php" method="post">
                
                <div class="form-group">
                    <select id="fournisseur" class="form-control form-control-sm" name="fournisseur" required>
                        <option disabled selected hidden>Choisir le fournisseur</option>
                        <?php foreach($fournisseurs as $fournisseur) { ?>
                            <option value="<?php echo $fournisseur['id'] ?>"><?php echo $fournisseur['nom'] ?></option>
                        <?php } ?>
                    </select>    
                </div>
                <div class="form-group">
                    <select id="produit" name="produit" class="form-control form-control-sm" required>
                        <option selected hidden disabled>Choisir produit</option>
                    </select>    
                </div>
                
                
                <div class="form-group">
                    <input type="number" class="form-control form-control-sm" placeholder="montant" required name="montant">    
                </div>
                <div class="form-group">
                    <select class="form-control" name="devise" required>
                        <option disabled selected hidden>Choisir la devise</option>
                        <?php foreach ($devises as $devise) { ?>
                            <option value="<?php echo $devise['id'] ?>"><?php echo $devise['nom_devise'] ?></option>
                        <?php } ?>
                    </select>    
                </div>
                <input type="submit" name="form_fournisseur" class="btn btn-primary" value="enregistrer">
        </div>
        <div class="col-md-6 pt-5">
                <div class="form-group">
                    <select class="form-control form-control-sm" name="type_unites" id="type_unites">
                    
                    </select>    
                </div>
                
                <div class="form-group">
                    <select class="form-control form-control-sm" name="format_carte" id="format_cartes">
                    
                    </select>    
                </div>
                <div class="form-group">
                    <input type="number" name="quantite" id="quantite" class="form-control form-control-sm" placeholder="quantité" name="quantite">    
                </div>
           </form>
        
        </div>
    </div>
    <div class="row">
        <h2>Recents approvisionnements</h2>
        <div class="col-md-12">
            <table class="table table-hover">
                <thead >
                    <th>Date</th>
                    <th>Fournisseur</th>
                    <th>Produit</th>
                    <th>Quantite</th>
                    <th>Montant</th>
                    <th>devise</th>    
                </thead>
                <tbody>
                    <?php foreach ($derniers_fournissements as $fournissement) { ?>
                        <tr>
                            <td><?php echo $fournissement["date_fournissement"] ?></td>
                            <td><?php echo $fournissement["fournisseur"] ?></td>
                            <td><?php echo $fournissement["nom"]; ?></td>
                            <td><?php echo $fournissement["quantite_produit"] ?></td>
                            <td><?php echo $fournissement["montant"] ?></td>
                            <td><?php echo $fournissement["nom_devise"] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

    <!-- <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-4">
            <form accept="" method="post">
                <h2 class="text-center">Monnaie electronique</h2>

                <select class="form-control form-control-sm">
                <option>nom  du fournisseur</option>
                </select>
                <select class="form-control form-control-sm">
                <option>produit fournit</option>
                </select>
                <input type="number" class="form-control form-control-sm" placeholder="quantité" required>
                <input type="number" class="form-control form-control-sm" placeholder="montant" required>
                <select class="form-control">
                <option>devise</option>
                </select>

                <input type="submit" class="btn btn-primary block" value="enregistrer">
                <input type="submit" class="btn btn-danger" value="annuler">
            </form>
        </div>
        <div class="col-md-5">
        <h2 class="text-center">liste fournie</h2>
            <table class="table">
                <th>nom element</th>
                <th>type element</th>
                <th>quantité</th>
            </table>
        </div>
    </div> -->
     <!-- Javascript Files  -->
     <script type="text/javascript" src="../assets/js/jquery-3.3.1.min.js"></script>
     <script type="text/javascript" src="../assets/js/ajax/tri_produit__fournisseur.js"></script>
     <!-- <script type="text/javascript" src="../assets/js/app.js"></script> -->
     <!-- <script type="text/javascript" src="../js/materialize.min.js"></script>
     <script type="text/javascript" src="../js/materialize.js"></script> -->
</body>
</html>