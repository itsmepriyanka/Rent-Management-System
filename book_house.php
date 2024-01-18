<?php
session_start();
if (!isset($_SESSION['tenant_email'])) {
    echo 'failure';
} else {
    // Include your database connection
    require_once 'db_connect.php';

    // Retrieve tenant and house IDs from the AJAX request
    $tenant_id = $_POST['tenant_id'];
    $house_id = $_POST['house_id'];

    // Create an SQL query to insert a new booking
    $sql = "INSERT INTO bookings (tenant_id, house_id, booking_date) VALUES ('$tenant_id', '$house_id', NOW())";

    if ($conn->query($sql) === TRUE) {
        // Booking successful
        echo 'success';
    } else {
        // Booking failed
        echo 'failure';
    }

    $conn->close();
}
?>
