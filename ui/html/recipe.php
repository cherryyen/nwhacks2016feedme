<?php
$servername = "85.10.205.173";
$username = "food";
$password = "givemefood";
$dbname = "feedme";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";

$name = $_POST['Name'];
echo $name; 

$query = "SELECT rp.Name, rp.Recipe_Des AS des, rp.Description AS proc FROM `Recipe_Procedure` rp WHERE rp.Name = ". $name ."";
$result = $conn->query($query);

if($result === false) {
	trigger_error('Wrong SQL: ' . $query . ' Error: ' . $conn->error, E_USER_ERROR);
	} else {
		while ($row = $result->fetch_assoc()) {
			//echo $row['txt'] . '<br>';
			//echo $row['des'] . '<br>';
			$recipeTable[] = $row; 
		}
	}

echo json_encode($recipeTable);
	
$result->free(); 
$conn->close();
?>