$(document).ready(function(){
	$("#ingButton").click(function(){
		$("#ingButton").hide();
		$("#addIngredientMenu").show();
		$('#b1').prop('disabled', true);
		$('#addIngredients').prop('disabled', true);
	});

	var recipeName; 
	var recipeDes; 
	var recipeProcedure; 

	function getRecipe() {
		$.ajax({
			url: './ingredients.php',
			type: 'POST',
			success: function(result) {
				//$("#recipeProcedures").html(data)
				console.log(data); 


				var data = $.parseJSON(result); 
				/*	
				for (i = 0; i < data.length; ++i) {
					recipeName = data[i].txt;
					recipeDes = data[i].des;
				}
				*/

				for (i  = 0; i < data.length; ++i) {
					console.log(data[i])
					recipeName = data[i].txt;
					recipeDes = data[i].des;
					recipeProcedure = data[i].proc;
				}


				$("#recipeName").text(recipeName);
				$("#recipeProcedures").text(recipeDes);
				$("#recipeProcedures").append('<br><br><p>' + recipeProcedure + '</p>');

			}
		});
	}

	getRecipe();

});
