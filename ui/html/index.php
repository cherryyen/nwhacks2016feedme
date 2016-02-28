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

//echo "<script>alert('yay')</script>";

$data = $_POST['name'];


$sql = "INSERT INTO User_Ingredient (Name)
VALUES ('" . $data. "')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>