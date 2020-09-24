<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique agent</title>
</head>
<body>
    <?php include('navbar.php'); ?>
     <div class="row">
         <div class="col-md-6">
                <h2 class="text-center">Historique Agent</h2>
                <form action="" method="post">
                    <label for="InputAgentForm" class="text">type produit</label>
                    <select name=""  id="InputAgentForm" class="form-control">
                        <option value="">angent form</option>
                    </select>
                    <label for="inputMont">montant</label>
                    <input type="number" id="inputMont" class="form-control" name="montant">
                    <label for="inputQte">Quantité</label>
                    <input type="number" id="inputQte" name="quantite" class="form-control">
                    <label for="inputType">nom du type</label>
                    <select name="id" id="inputType" class="form-control">
                            <option value="">nom du type</option>
                    </select>
                    <label for="inputCarte">format carte</label>
                    <select name="id" id="inputCarte" class="form-control">
                            <option value="">20u</option>
                            <option value="">50u</option>
                    </select>
                    <label for="inputDate">la date de l'operation</label>
                    <input type="date" id="inputDate" name="dateForm" class="form-control"></br>

                    <input type="submit" value="enregistrer" class="btn btn-outline-primary btn-block">
                    <input type="submit" value="annuler" class="btn btn-outline-danger btn-block">
                </form>
         </div>
         <div class="col-md-6"> 
             <h2 class="text-center">historique</h2>
             <table class="table">
                 <tr>
                     <th>agent</th>
                     <th>quantite</th>
                     <th>montant</th>
                     <th>update</th>

                 </tr>
                 <tr>

                 </tr>
             </table>

         </div>
     </div>
</body>
</html>