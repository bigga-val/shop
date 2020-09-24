<?php 

    require_once('../model/agent.class.php');
    $agent = new Agent();
    $agents = $agent->afficher_agents();

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>stock agent</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css"/>
    <!-- <link rel="stylesheet" type="text/css" href="../assets/bootstrap.css"> -->
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css"/>
</head>
<body>
    <?php include('navbar.php'); ?>
    <div class="container">
        <div class="row">
        <div class="col-md-6">
             <h2 class="text-center">stock agent</h2>
             <form action="" method="">
                  <div class="form-group">
                      <label for="inputIdP">Agent</label>
                      <select name="" id="inputIdP" class="form-control">
                          <?php foreach ($agents as $agent) {  ?>
                              <option value="<?php echo $agent['id'] ?>"><?php echo $agent['prenom']; ?></option>
                          <?php } ?>
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="inputQte">quantite</label>
                      <input type="number" id="inputQte" class="form-control" name="" >
                  </div>
                  <div class="form-group">
                      <label for="inputmont">Montant initial</label>
                      <input type="number" id="inputmont" name="montantInitial" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="montOp">montant operation</label>
                      <input type="number" id="monOp" class="form-control" name="montantOperation">
                  </div>
                  <div class="form-group">
                      <label for="reste">Reste </label>
                      <input type="number" id="reste" class="form-control" name="resteMontant">
                  </div>
                  <div class="form-group">
                      <label for="QteInitial"> quantite Initiale</label>
                      <input type="number" id="QteInitial" name="quantiteInitiale" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="idHist"> historique</label>
                      <select name="" id="idHist" class="form-control">
                          <option value="">id historique</option>
                      </select>
                  </div>
             </form>
              <input type="submit" value="enregistrer" class="btn btn-outline-primary btn-block">
              <input type="submit" value="annuler" class="btn btn-outline-danger btn-block">
        </div>
        <div class="col-md-6">

        </div>
    </div>  
    </div>
    
</body>
</html>