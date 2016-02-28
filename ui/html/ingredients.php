<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title>FEED ME</title>


	<link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/index.css" rel="stylesheet">


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
  <script src="js/databaseconnection.js"></script>

</head>

<body> 

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">FEED ME</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">HOME <span class="sr-only">(current)</span></a></li>
        <li><a href="#">MY INGREDIENTS <span class="sr-only">(current)</span></a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

  <div id="ingredients">
    <center>
<?php

$servername = "85.10.205.173";
$username = "food";
$password = "givemefood";
$dbname = "feedme";
$conn = mysqli_connect($servername, $username, $password, $dbname);
$sql = "SELECT Name FROM User_Ingredient";
$result = mysqli_query($conn, $sql);

$userIngredients = array();

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      $userIngredients[]=$row['Name'];
         echo $row['Name']. "<br>";
    }
} else {
    echo "0 results";
}

$recipes = array();

$sqlmatchRecipe = "SELECT DISTINCT r.Name 
From Recipe r, Ingredient i, Recipe_Ingredient ri, User_Ingredient ui 
Where r.ID = ri.Recipe_ID 
AND ri.Ingredient_ID = i.ID 
AND i.Name = ui.Name";

$result1 = mysqli_query($conn, $sqlmatchRecipe);
if (mysqli_num_rows($result1) > 0) {
    while($row = mysqli_fetch_assoc($result1)) {
      $recipes[]=$row['Name'];
    }
} else {
    echo "0 results";
}

$breakfast = array();
$lunch = array();
$dinner = array();

$sqlCat = "SELECT r.Name, r.Category from Recipe r";
$result2 = mysqli_query($conn, $sqlCat);

if (mysqli_num_rows($result2) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result2)) {
      if ($row['Category']=="Breakfast"){
        $breakfast[]=$row['Name'];
      }
      if ($row['Category']=="Lunch"){
        $lunch[]=$row['Name'];
      }

      if ($row['Category']=="Dinner"){
        $dinner[]=$row['Name'];
      }

      if ($row['Category']=="Dessert"){
        $dessert[]=$row['Name'];
      }
    }
}

/*
$query = "SELECT rp.Name AS txt, rp.Recipe_Des AS des, rp.Description AS proc FROM `Recipe_Procedure` rp";
$gimmeRecipe = $conn->query($query);

if($gimmeRecipe === false) {
  trigger_error('Wrong SQL: ' . $query . ' Error: ' . $conn->error, E_USER_ERROR);
  } else {
    while ($row = $gimmeRecipe->fetch_assoc()) {
 
      $recipeTable[] = $row; 
    }
  }

echo '<div id="recipes" style="visibility: hidden">'. json_encode($recipeTable) .'</div>';
//echo <json_encode($recipeTable);
  
$gimmeRecipe->free(); 
*/
$conn->close();

?>


      <button type="submit" class="btn btn-default" id="makeFood" onclick="">What can I make?</button>
    </center>

  </div>

  <div id="categories">
    <center>
      CATEGORIES<p>
      <button type="submit" class="btn btn-default" id="allFood" onclick="">All</button><p>
      <button type="submit" class="btn btn-default" id="breakfast" onclick="">Breakfast</button><p>
      <button type="submit" class="btn btn-default" id="lunch" onclick="">Lunch</button><p>
      <button type="submit" class="btn btn-default" id="dinner" onclick="">Dinner</button><p>
      <button type="submit" class="btn btn-default" id="dessert" onclick="">Dessert</button><p>

    </center>
  </div>

  <div id="all">
    <center>
      <script>
        var all = <?php echo json_encode($recipes); ?>;
        
        for (i=0; i < all.length; i++){
          document.write(all[i] + "<br>");
        }

      </script>
    </center>
  </div>

  <div id="breakf">
    <center>
      <script>
        var goodfast = new Array();
        var breakfast = <?php echo json_encode($breakfast); ?>;
        var recipes = <?php echo json_encode($recipes); ?>;

    for (i=0; i < recipes.length; i++){
      for (j=0; j < breakfast.length; j++){
        if (recipes[i].match(breakfast[j])){
          goodfast.push(recipes[i]);
        }
      }
    }
    
    for (i=0; i < goodfast.length; i++){
        //$('#input1').attr('name', 'other_amount');
        //$("recipeID" + i).attr('name', goodfast[i]);


        var input = $('<input type="button" value="' + goodfast[i] + '" id= "recipeID"' + i + ' name="break"/>');
        input.appendTo($("#breakf"));
  
        //var btnb = $.button.set('btn btn-primary');
        //var txt = document.createTextNode(goodfast[i]);
        //btnb.setAttribute('id','recipeID' + i);
        //btnb.setAttribute('text', goodfast[i]);

        //$("#breakf").after(btnb);


        //btn.appendChild(txt);
        //btn.setAttribute('type', 'button');
        //btn.setAttribute('onclick', functions[i]);
        //btn.setAttribute('id', 'recipeID' + i);
        //div.appendChild(btn);


        //alert(recipes); 
        
          //document.write(goodfast[i] + "<br>");
        }

      </script>
    </center>
  </div>

  <div id="lunchf">
    <center>
      <script>
        var goodlunch = new Array();
        var lunch = <?php echo json_encode($lunch); ?>;
        var recipes = <?php echo json_encode($recipes); ?>;

    for (i=0; i < recipes.length; i++){
      for (j=0; j < lunch.length; j++){
        if (recipes[i].match(lunch[j])){
          goodlunch.push(recipes[i]);
        }
      }
    }
    
    for (i=0; i < goodlunch.length; i++){
          document.write(goodlunch[i] + "<br>");
        }

      </script>
    </center>
  </div>

    <div id="dinnerf">
    <center>
      <script>
        var gooddin = new Array();
        var dinner = <?php echo json_encode($dinner); ?>;
        var recipes = <?php echo json_encode($recipes); ?>;

    for (i=0; i < recipes.length; i++){
      for (j=0; j < dinner.length; j++){
        if (recipes[i].match(dinner[j])){
          gooddin.push(recipes[i]);
        }
      }
    }

    for (i=0; i < gooddin.length; i++){
          document.write(gooddin[i] + "<br>");
        }
    
      </script>
    </center>
  </div>

  <div id="dessertf">
    <center>
      <script>
        var gooddes = new Array();
        var dessert = <?php echo json_encode($dessert); ?>;
        var recipes = <?php echo json_encode($recipes); ?>;

    for (i=0; i < recipes.length; i++){
      for (j=0; j < dessert.length; j++){
        if (recipes[i].match(dessert[j])){
          gooddes.push(recipes[i]);
        }
      }
    }
    
    for (i=0; i < gooddes.length; i++){
        document.write(gooddes[i] + "<br>");
        }
    
      </script>
    </center>
  </div>

</body>
</html>