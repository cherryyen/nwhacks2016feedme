$(document).ready(function(){
	$("#ingButton").click(function(){
		$("#ingButton").hide();
		$("#addIngredientMenu").show();
		$('#b1').prop('disabled', true);
		$('#addIngredients').prop('disabled', true);
	});

	var next = 1; 

	function addIngredientCheck() {
		$("#ingText" + next).each(function () {
	    	$(this).keyup(function () {
	        	$('#b1').prop('disabled', CheckInputs());
	        	$('#addIngredients').prop('disabled', CheckInputs);
	    	});
		});

		function CheckInputs() {
			var valid = false; 
			$(".inputText").each(function () {
       			if (valid) { return valid; }
        		valid = !$.trim($(this).val());
    		});
    		return valid;
		}
	}

	addIngredientCheck();

	$(".btn-add").click(function(e){
		e.preventDefault(); 

		var addBtn = "#ingText" + next; 
		var addRemove = "#ingText" + next; 
		next = next + 1; 

		var newInput = '<input type="text" class="inputText" id="ingText' + next + '" name="ing' + next + '" type="text"/>';
		var setInput = $(newInput); 

		var removeBtn = '<button class="btn btn-danger remove-me" id="removeb' + (next - 1) + '">-</button></div><div id="inputIng">';
		var setRemove = $(removeBtn);

		$(addBtn).after(setInput); 
		$(addRemove).after(setRemove); 
		$("inputIng" + next).attr('data-source',$(addBtn).attr('data-source'));
		$("#count").val(next);
		//$('#b1').prop('disabled', true);

		addIngredientCheck();

			$(".remove-me").click(function(e){
				e.preventDefault(); 
				var ingTextNum = this.id.charAt(this.id.length-1); 
				var ingID = "#ingText" + ingTextNum; 
				alert(ingID);
				$(this).remove();
				$(ingID).remove(); 
				alert(next);
			});
		});

	$("#addIngredients").click(function(e){
		e.preventDefault(); 
		var checkIngredient = "#ingText" + next; 
		var ingredientText = $(checkIngredient);
		while (next != 0) {
			if (ingredientText.val() !== undefined) {
				//alert("Oh look value for:" + next + " and ingredient: " + ingredientText.val());
				addIngredientToDB(ingredientText.val());
			}
			next = next - 1; 
			checkIngredient = "#ingText" + next; 
			ingredientText = $(checkIngredient);
		}
	});

	function addIngredientToDB(ingName) {
		$.ajax({
			url: './index.php',
			type: 'POST',
			data: {'name': ingName},
			success: function(data) {
				console.log(data);
				$("#addIngredientMenu").hide();
				$('#addIngredients').prop('disabled', true);
				$("#ingButton").show();
				//$('.input-ingredients').trigger("reset");
				//$("#food-content").html(data)
			}
		});
	}

	$(document).ready(function(){
	$("#categories").hide();
	$("#all").hide();
	$("#breakf").hide();
	$("#lunchf").hide();
	$("#dinnerf").hide();
	$("#dessertf").hide();
    $("#makeFood").click(function(){
        $("#ingredients").hide();
        $("#categories").show();
    });
    $("#allFood").click(function(){
        $("#ingredients").hide();
        $("#categories").hide();
        $("#all").show();
    });
    $("#breakfast").click(function(){
        $("#ingredients").hide();
        $("#categories").hide();
        $("#all").hide();
        $("#breakf").show();
    });
    $("#lunch").click(function(){
        $("#ingredients").hide();
        $("#categories").hide();
        $("#all").hide();
        $("#breakf").hide();
        $("#lunchf").show();
    });
    $("#dinner").click(function(){
        $("#ingredients").hide();
        $("#categories").hide();
        $("#all").hide();
        $("#breakf").hide();
        $("#lunchf").hide();
        $("#dinnerf").show();
    });
    $("#dessert").click(function(){
        $("#ingredients").hide();
        $("#categories").hide();
        $("#all").hide();
        $("#breakf").hide();
        $("#lunchf").hide();
        $("#dinnerf").hide();
        $("#dessertf").show();
    });


     $("input[name = 'break']").click(function(){
    	var recipeName = this.value; 
   		getRecipe(recipeName)
	});
     $("input[name = 'lunch']").click(function(){
    	//do stuff
	});
     $("input[name = 'dindin']").click(function(){
    	//do stuff
	});
     $("input[name = 'dessert']").click(function(){

     }); 


	$("#ingButton").click(function(){
		$("#ingButton").hide();
		$("#addIngredientMenu").show();
		$('#b1').prop('disabled', true);
		$('#addIngredients').prop('disabled', true);
	});

	var recipeName; 
	var recipeDes; 
	var recipeProcedure; 

	function getRecipe(recipeName) {
		$.ajax({
			url: './recipe.php',
			type: 'POST',
			data: {'txt' : recipeName},
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
});

