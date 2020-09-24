$(document).ready(function(){
	let agent = $("#agent");
	agent.on("change", function(){
		console.log($(this).val());
		$.ajax({
			type:"post",
			url:"../controller/categorie_produit_agent_controller.php",
			data:"agent="+agent.val(),
			success:function(data){
				console.log(data);
				$("#categories").html(data);
			},
			error:function(e){
				console.log(e);
			}
		})

	});
});