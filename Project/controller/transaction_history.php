<?php
session_start();
include '../database/config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

$transactions_query = "SELECT * FROM transactions";
$transactions_result = $conn->query($transactions_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History - Admin Dashboard</title>
    <link rel="stylesheet" href="../style/style.css">
    
</head>
<body>
    <div class="dashboard-container">
        <h2>Transaction History</h2>
        <a href="../View/dashboard.php">Back to Dashboard</a>

        <h3>All Transactions</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Customer Id</th>
                <th>Transaction Type</th>
                <th>Amount</th>
                <th>Date</th>
            </tr>
            <?php while ($transaction = $transactions_result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $transaction['id']; ?></td>
                <td><?php echo $transaction['customer_id']; ?></td>
                <td><?php echo ucfirst($transaction['type']); ?></td>
                <td><?php echo $transaction['amount']; ?></td>
                <td><?php echo $transaction['transaction_date']; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
