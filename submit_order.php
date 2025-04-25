<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['customer_name'];
    $phone = $_POST['customer_phone'];
    $address = $_POST['customer_address'];
    $order_items = $_POST['ordered_items']; // This is JSON from JS

    // Optional: Decode JSON into an array
    $items_array = json_decode($order_items, true);
    $items_string = implode(", ", $items_array); // Store as comma-separated string

    $sql = "INSERT INTO orders (customer_name, phone, address, order_items)
            VALUES ('$name', '$phone', '$address', '$items_string')";

    if ($conn->query($sql) === TRUE) {
        echo "Order submitted!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
?>
