<?php
// Assuming you have established a connection to your database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tech";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form inputs
$email = $_POST['email'];
$password = $_POST['password'];


// Sanitize user input to prevent SQL injection
$email = mysqli_real_escape_string($conn, $email);
$password = mysqli_real_escape_string($conn, $password);
// Prepare and execute SQL statement
$sql = "INSERT INTO reg (email, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $password);
$stmt->execute();

// Check if the record was inserted successfully
if ($stmt->affected_rows > 0) {
    echo "Record inserted successfully";
} else {
    echo "Error inserting record: " . $conn->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>