$(document).ready(function(){
	$("#ingButton").click(function(){
		$("#ingButton").hide();
		$("#addIngredientMenu").show();
		$('#b1').prop('disabled', true);
	});

	var next = 1; 

	function addIngredientCheck() {
		$("#ingText" + next).each(function () {
	    	$(this).keyup(function () {
	        	$('#b1').prop('disabled', CheckInputs());
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
		$('#b1').prop('disabled', true);
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
				alert("Oh look value for:" + next + " and ingredient: " + ingredientText.val());
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
				alert("asdfasdfadf");
				console.log(data);
				$("#addIngredientMenu").hide();
				$("#ingButton").show();

				$("#food-content").html(data)

			}
		});

		
		//load();
	}
});

/*
function load(){
	if(window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
	}

	http.setRequestHeader("")

	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById('food-content').innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open('get', './index.php', true);
	xmlhttp.send();
}
*/