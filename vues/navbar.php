<nav class="nav navbar-dark bg-dark text-white justify-content-end">
    <li class="nav-item">
    	<a class="nav-link text-white" href="index.php">Approvisionnement</a>	
    </li>
    <li class="nav-item">
    	<a class="nav-link text-white" href="stockgerant.php">Stock gerant</a>	
    </li>
    <li class="nav-item">
    	<a class="nav-link text-white" href="choix_categorie_produit_agent.php">Stock Agent</a>	
    </li>
    <?php if(isset($_SESSION['login'])){?>
	    <li class="nav-item border border-right-0 border-top-0 border-bottom-0">
	    	<a class="nav-link">
	    		<?php echo "connecté, ". ucfirst($_SESSION['login']) ?>
	    	</a>
	    </li>
		<li class="nav-item">
			<a class="nav-link btn btn-outline-danger" href="../controller/deconnexion.php">Deconnexion</a>
		</li>
	<?php } ?>	
</nav>     