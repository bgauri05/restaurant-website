<?php
include 'db_connect.php'; // Connect to database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $location = htmlspecialchars($_POST['location']);
    $people = htmlspecialchars($_POST['people']);
    $datetime = $_POST['datetime'];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO table_bookings (name, phone, location, people, reservation_datetime) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $phone, $location, $people, $datetime);

    if ($stmt->execute()) {
        echo "✅ Table booked successfully!";
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
