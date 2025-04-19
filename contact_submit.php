<?php
include 'db_connect.php';

$fname = $_POST['first_name'];
$lname = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

$sql = "INSERT INTO contact_messages (first_name, last_name, email, phone, message)
        VALUES ('$fname', '$lname', '$email', '$phone', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "Message sent!";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>