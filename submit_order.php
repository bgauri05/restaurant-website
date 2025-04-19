<?php
include 'db_connect.php';

$name = $_POST['name'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$order_items = $_POST['order_items'];

$sql = "INSERT INTO orders (customer_name, phone, address, order_items)
        VALUES ('$name', '$phone', '$address', '$order_items')";

if ($conn->query($sql) === TRUE) {
    echo "Order submitted!";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>