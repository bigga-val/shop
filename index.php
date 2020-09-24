<?php 

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Login - Prince Shop</title>
 	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css"/>
    <!-- <link rel="stylesheet" type="text/css" href="../assets/bootstrap.css"> -->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css"/>
 </head>
 <body>
 	<div class="container-fluid">
 		<div class="row">
 			<div class="col-3"></div>
 			<div class="col-6 bg- p-5">
 				<img src="#!" alt="Logo" class="centered">
 				<form class="m-5 p-5 border border-success border-5" method="post" action>
 					<div class="form-group">
 						<input type="email" name="email" id="email" class="form-control border border-success rounded" placeholder="Email">
 					</div>
 					<div class="form-group">
 						<input type="password" name="password" id="password" class="form-control border border-success rounded" placeholder="Mot de passe">
 					</div>
 					<input type="submit" name="btn_connexion" class="btn btn-success">
 				</form>
 			</div>
 			<div class="col-3"></div>
 		</div>
 	</div>
 </body>
 </html>