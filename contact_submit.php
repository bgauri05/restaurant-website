<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = ""; // or your actual DB password
$database = "restaurant_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$first_name = $_POST['first_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$message = $_POST['message'] ?? '';

// Basic validation
if (empty($first_name) || empty($last_name) || empty($email) || empty($message)) {
  echo "Please fill out all required fields.";
  exit;
}

// Prepare SQL using your table 'contact_messages'
$sql = "INSERT INTO contact_messages (first_name, last_name, email, phone, message) 
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
  echo "Database error: " . $conn->error;
  exit;
}

$stmt->bind_param("sssss", $first_name, $last_name, $email, $phone, $message);

if ($stmt->execute()) {
  echo "Thank you! Your message has been sent.";
} else {
  echo "Something went wrong. Please try again.";
}

$stmt->close();
$conn->close();
?>

