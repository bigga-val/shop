$(document).ready(function(){
	let fournisseur = $("#fournisseur");
	let produit = $("#produit");
	let ayant_type = [8, 9, 10, 11];
	let prod;
	$("#type_unites").hide();
	$("#format_cartes").hide();
	fournisseur.on("change", function(e){
		// console.log($(this).val());
		f = $(this).val();
		$.ajax({
			type: "post",
			url: "../controller/fournisseur_controller.php",
			data: "fournisseur="+f,
			success: function(data){
				produit.html(data);
				for(let i = 0; i < ayant_type.length; i++){
					if(produit.val() == ayant_type[i]){
						$("#type_unites").show();
						$("#format_cartes").show();
						//console.log(produit.val());
						prod = produit.val();
						break;
					}else{
						//$("#type_unites").attr('disactivad', 'disactivad');
						$("#type_unites").hide();
						$("#format_cartes").hide();
						prod = produit.val();
					}	
				}
				$.ajax({
					type:"post",
					url:"../controller/fournisseur_controller.php",
					data:"produit="+prod,
					success:function(data){
						let type_unites = $("#type_unites");
						type_unites.html(data);
						typeunites = type_unites.val()
						if(typeunites != null){
							$.ajax({
								type:"post",
								url:"../controller/fournisseur_controller.php",
								data:"typeunites="+typeunites,
								success:function(data){
									// console.log(data);
									$("#format_cartes").html(data);
								},
								error:function(e){
									console.log(e);
								}
							})
						}

					}
				})

			},
			error: function(e){
				console.log("Erreur:".e);
			}
		})
	})
})