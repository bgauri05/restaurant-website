<?php
include 'db_connect.php';

$name = $_POST['full_name'];
$phone = $_POST['phone_number'];
$address = $_POST['address'];

$sql = "INSERT INTO delivery_info (full_name, phone_number, address)
        VALUES ('$name', '$phone', '$address')";

if ($conn->query($sql) === TRUE) {
    echo "Delivery info received!";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>