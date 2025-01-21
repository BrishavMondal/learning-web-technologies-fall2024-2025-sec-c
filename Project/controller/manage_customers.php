<?php
session_start();
include '../database/config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

// Fetch all customers
$customers_query = "SELECT * FROM customers";
$customers_result = $conn->query($customers_query);

// Delete customer functionality
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM customers WHERE id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        header("Location: ../View/manage_customers.php");
        exit();
    } else {
        echo "Error deleting customer!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Customers - Admin Dashboard</title>
    <link rel="stylesheet" href="../style/style.css">
    
</head>
<body>
    <div class="dashboard-container">
        <h2>Manage Customers</h2>
        <a href="../View/dashboard.php">Back to Dashboard</a>

        <h3>Customers List</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Balance</th>
                <th>Action</th>
            </tr>
            <?php while ($customer = $customers_result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $customer['id']; ?></td>
                <td><?php echo $customer['first_name']; ?></td>
                <td><?php echo $customer['last_name']; ?></td>
                <td><?php echo $customer['email']; ?></td>
                <td><?php echo $customer['balance']; ?></td>
                <td>
                    <a href="../View/edit_customer.php?id=<?php echo $customer['id']; ?>">Edit</a> |
                    <a href="?delete_id=<?php echo $customer['id']; ?>" onclick="return confirm('Are you sure you want to delete this customer?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
