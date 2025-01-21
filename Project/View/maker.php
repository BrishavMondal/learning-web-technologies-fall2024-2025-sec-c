<?php
session_start();
include '../database/config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'maker') {
    header("Location: ../auth/login.php");
    exit();
}


$customers_query = "SELECT * FROM customers";
$customers_result = $conn->query($customers_query);

$transactions_query = "SELECT * FROM transactions";
$transactions_result = $conn->query($transactions_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
      <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <div class="dashboard-container">
    <h2>Maker Dashboard</h2>
    <div class="menu">
    <a href="../controller/Enquery.php">Enquiry</a>
    <a href="../controller/createtAccount.php">Create Account</a>
    <a href="../controller/reject.php">Reject Request</a>
    <a href="../controller/ReturnRequest.php">Return Request</a>
    <a href="../auth/logout.php">Logout</a>
   </div>
    </div>
</body>
</html>