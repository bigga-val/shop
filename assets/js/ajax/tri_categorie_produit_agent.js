$(document).ready(function(){
	let agent = $("#agent");
	agent.on("change", function(){
		// console.log($(this).val());
		$.ajax({
			type:"post",
			url:"../controller/categorie_produit_agent_controller.php",
			data:"agent="+agent.val(),
			success:function(data){
				// console.log(data);
				$("#categories").html(data);
				$("input[name=categorie]")[0].checked = true;
				// console.log($("input[name=categorie]:checked").val());
				$("#btn_voir_stock").on("click", function(){
				// $("input[name=categorie]").on("check", function(){
					let c = $("input[name=categorie]:checked").val();
					// let v = $(this).val();
					$("#tableau_stock").html('<div class="spinner-border text-info"></div>');
					console.log(c);
					let agent = $("#agent").val();
					$.ajax({
						type:"post",
						url:"../controller/categorie_produit_agent_controller.php",
						data:"id_agent="+agent+"&id_categorie="+c,
						success:function(data){
							$("#tableau_stock").html(data);
							// console.log(data);
						},
						error:function(e){
							console.log(e);
						}
					})
				})
			},
			error:function(e){
				console.log(e);
			}
		})

	});
});