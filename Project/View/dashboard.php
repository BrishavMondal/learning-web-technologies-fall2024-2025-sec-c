<?php
session_start();
include '../database/config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
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
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../style/style.css">
    
</head>
<body>
    <div class="dashboard-container">
        <h2>Admin Dashboard</h2>
        <div class="menu">
            <a href="../controller/manage_customers.php">Manage Customers</a>
            <a href="../controller/transaction_history.php">Transaction History</a>
            <a href="../controller/balance_management.php">Balance Management</a>
            <a href="../controller/loan_services.php">Loan Services</a>
            <a href="../controller/security.php">Security</a>
            <a href="../auth/logout.php">Logout</a>
        </div>

        <h3>Customers List</h3>
       <table>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Balance</th>
                
            </tr>
            <?php while ($customer = $customers_result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $customer['id']; ?></td>
                <td><?php echo $customer['first_name']; ?></td>
                <td><?php echo $customer['last_name']; ?></td>
                <td><?php echo $customer['email']; ?></td>
                <td><?php echo $customer['balance']; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
