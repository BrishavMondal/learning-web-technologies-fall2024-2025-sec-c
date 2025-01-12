<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch all customers
$customers_query = "SELECT * FROM employers";
$customers_result = $conn->query($customers_query);

// Delete customer functionality
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM employers WHERE id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        header("Location: manage_customers.php");
        exit();
    } else {
        echo "Error deleting employe!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Customers - Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
    <div class="dashboard-container">
        <h2>Manage Empolye </h2>
        <a href="register_employer.php">Add employe</a>

        <h3>Employe  List</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Company Name</th>
                <th>Contact No</th>
                <th>User Name </th>
                <th>PassWord</th>
            </tr>
            <?php while ($customer = $customers_result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $customer['id']; ?></td>
                <td><?php echo $customer['employer_name']; ?></td>
                <td><?php echo $customer['company_name']; ?></td>
                <td><?php echo $customer['contact_no']; ?></td>
                <td><?php echo $customer['username']; ?></td>
                <td><?php echo $customer['password']; ?></td>
                <td>
                    <a href="">Edit</a> |
                    <a href="?delete_id=<?php echo $customer['id']; ?>" onclick="return confirm('Are you sure you want to delete this customer?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
