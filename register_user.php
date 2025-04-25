<?php
include 'db_connect.php'; // Ensure DB connection is working

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize inputs
    $full_name = $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $birth_date = $_POST['dob'] ?? null;
    $anniversary_date = $_POST['anniversary'] ?? null;
    $cuisine = $_POST['cuisine'] ?? '';
    $preferences = $_POST['dietary_restrictions'] ?? '';
    $communication = $_POST['communication'] ?? '';
    $wants_promos = isset($_POST['promotional_opt_in']) ? 1 : 0;

    // Check if email already exists
    $check_stmt = $conn->prepare("SELECT id FROM registrations WHERE email = ?");
    if (!$check_stmt) {
        die("Prepare failed (check): " . $conn->error);
    }

    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        echo "<script>alert('This email is already registered. Please login or use another email.'); window.history.back();</script>";
        $check_stmt->close();
        $conn->close();
        exit();
    }
    $check_stmt->close();

    // Proceed with insertion if email is new
    $stmt = $conn->prepare("INSERT INTO registrations 
        (full_name, email, phone, birth_date, anniversary_date, favorite_cuisine, dietary_preferences, preferred_communication, wants_promos)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssssssssi", $full_name, $email, $phone, $birth_date, $anniversary_date, $cuisine, $preferences, $communication, $wants_promos);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful! Login and check out your membership perks!'); window.location.href='membership.html';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
