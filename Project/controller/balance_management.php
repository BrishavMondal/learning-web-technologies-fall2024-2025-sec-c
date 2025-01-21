<?php
include '../database/config.php';
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_balance'])) {
    $customer_id = $_POST['customer_id'];
    $new_balance = $_POST['new_balance'];

    $stmt = $conn->prepare("UPDATE customers SET balance = ? WHERE id = ?");
    $stmt->bind_param("di", $new_balance, $customer_id);
    if ($stmt->execute()) {
        echo "Balance updated successfully!";
    } else {
        echo "Error updating balance.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balance Management</title>
    <link rel="stylesheet" href="../style/style.css">
    
</head>
<body>
    <div class="dashboard-container">
        <h2>Balance Management</h2>
        <form method="POST">
            <label for="customer_id">Customer ID:</label>
            <input type="number" id="customer_id" name="customer_id" required>

            <label for="new_balance">New Balance:</label>
            <input type="number" step="0.01" id="new_balance" name="new_balance" required>

            <button type="submit" name="update_balance">Update Balance</button>
        </form>

        <a href="../view/dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
