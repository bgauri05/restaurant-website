<?php
session_start(); // Start the session

$host = 'localhost';
$db   = 'restaurant_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Get form data
    $name = $_POST['login_name'];
    $dob  = $_POST['login_dob']; // Use the correct field name from the form

    // Query to check if member exists (changed dob to birth_date)
    $stmt = $pdo->prepare("SELECT * FROM registrations WHERE full_name = ? AND birth_date = ?");
    $stmt->execute([$name, $dob]);
    $user = $stmt->fetch();

    if ($user) {
        // Set session variable to store user info
        $_SESSION['user'] = $user['full_name']; // Store name or any other info

        // Redirect to perks page
        header("Location: perks.php");
        exit();
    } else {
        // Not a member - alert and redirect back
        echo "<script>
            alert('You are not a registered member. Please sign up first.');
            window.location.href = 'membership.html';
        </script>";
        exit();
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>


