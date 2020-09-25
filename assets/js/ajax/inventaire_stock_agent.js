$(document).ready(function(){
	let montant_initial = $("#montant_initial");
	let montant_operations = $("#montant_operations");
	let montant_restant = $("#montant_restant");
	let quantite_initiale = $("#quantite_initiale");
	let quantite_operations = $("#quantite_operations");
	let quantite_restante = $("#quantite_restante");

	montant_operations.keyup(function(){
		
		if(isNaN($(this).val())){
			console.log("pas un nombre")
		}else if($(this).val().length >= 3){
			let mont_rest = montant_initial.val() - $(this).val()
			montant_restant.attr("value", mont_rest)
			console.log(mont_rest)
		}else{
			
		}
	})

	quantite_operations.keyup(function(){
		if(!isNaN($(this).val())){
			console.log("numbre")
			let qte_rest = quantite_initiale.val() - $(this).val()
			quantite_restante.attr("value", qte_rest);
		}else{

		}
	})

})