$(document).ready(function(){
	let montant_disponiple = $("#montant_disponiple");
	let montant_retirable = $("#montant_disponiple");
	montant_retirable.keyup(function(){
		console.log(montant_disponiple.val());
		console.log($(this).val());

	})
})