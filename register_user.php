<?php
include 'db_connect.php'; // Make sure this connects correctly to the DB

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize inputs
    $full_name = $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $birth_date = $_POST['dob'] ?? null; // Make sure this matches the form input name
    $anniversary_date = $_POST['anniversary'] ?? null; // Make sure this matches the form input name
    $cuisine = $_POST['cuisine'] ?? '';
    $preferences = $_POST['dietary_restrictions'] ?? '';
    $communication = $_POST['communication'] ?? '';
    $wants_promos = isset($_POST['promotional_opt_in']) ? 1 : 0;

    // Prepare statement to insert data
    $stmt = $conn->prepare("INSERT INTO registrations 
        (full_name, email, phone, birth_date, anniversary_date, favorite_cuisine, dietary_preferences, preferred_communication, wants_promos)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Check if prepare() failed
    if (!$stmt) {
        die("❌ Prepare failed: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssssssssi", $full_name, $email, $phone, $birth_date, $anniversary_date, $cuisine, $preferences, $communication, $wants_promos);

    // Execute and give feedback
    if ($stmt->execute()) {
        echo "🎉 Registration successful!";
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
?>

