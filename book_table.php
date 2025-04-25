<?php

include 'db_connect.php'; // Connect to database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $name = htmlspecialchars(trim($_POST['name']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $location = htmlspecialchars(trim($_POST['location']));
    $people = htmlspecialchars(trim($_POST['people']));
    $datetime = trim($_POST['datetime']);

    // Validate phone number (10 digits)
    if (!preg_match('/^\d{10}$/', $phone)) {
        die("❌ Invalid phone number. It must be exactly 10 digits.");
    }

    // Validate datetime is not in the past
    $currentDateTime = date('Y-m-d\TH:i'); // Match datetime-local input format
    if ($datetime < $currentDateTime) {
        die("❌ You cannot book a table in the past.");
    }

    // Validate allowed location and people values
    $allowedLocations = ['juhu', 'Lower Parel', 'Bandra'];
    $allowedPeople = ['1 Person', '2 People', '3 People', '4+ People'];

    if (!in_array($location, $allowedLocations) || !in_array($people, $allowedPeople)) {
        die("❌ Invalid location or number of people selected.");
    }

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
