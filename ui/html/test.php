<script>
    // We define the variable and update it in a php
    // function defined in functions.php
    var giveme; 
</script>

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
echo "Connected successfully";

$giveme = "why you no pass";

echo $giveme;
//echo json_encode($test);

?>
