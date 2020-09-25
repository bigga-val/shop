$(document).ready(function(){
	let fournisseur = $("#fournisseur");
	let produit = $("#produit");
	let ayant_type = [8, 9, 10, 11];
	let prod;
	$("#type_unites").hide();
	$("#format_cartes").hide();
	$("#quantite").hide();
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
						$("#quantite").show();		
						//console.log(produit.val());
						prod = produit.val();
						break;
					}else{
						//$("#type_unites").attr('disactivad', 'disactivad');
						$("#type_unites").hide();
						$("#format_cartes").hide();
						$("#quantite").hide();
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
						console.log(typeunites);
						if(typeunites != null){
							$.ajax({
								type:"post",
								url:"../controller/fournisseur_controller.php",
								data:"typeunites="+typeunites,
								success:function(data){
									console.log(data);
									$("#format_cartes").html(data);
									$("#format_cartes").on("change", function(){
										console.log($(this).val());
									})
								},
								error:function(e){
								console.log(e);
								}
							})
						}
						type_unites.change(function(){
							console.log($(this).val())
							// console.log($("#tableau_cartes").val())
							let tab = $("#tableau_cartes").val().split(";")
							console.log(tab)
							if($(this).val() in tab){
								console.log("ok")
								$("#format_cartes").show()
								$("#quantite").show()
							}else{
								// console.log("absent")
								$("#format_cartes").hide()
								$("#quantite").hide()
							}
							
							
						})

					}
				})

			},
			error: function(e){
				console.log("Erreur:".e);
			}
		})
	})
})