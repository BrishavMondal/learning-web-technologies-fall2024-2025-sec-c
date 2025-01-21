<?php
include '../database/config.php';
session_start();


if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
         header("Location: ../auth/login.php");
    exit();
}


if (isset($_GET['id'])) {
    $customer_id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM customers WHERE id = ?");
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $customer = $result->fetch_assoc();

    if (!$customer) {
        echo "Customer not found.";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_id = $_POST['customer_id'];
    $name = $_POST['first_name'];
    $name = $_POST['last_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $stmt = $conn->prepare("UPDATE customers SET first_name = ?, last_name = ?, email = ?, address = ? WHERE id = ?");
    $stmt->bind_param("sssii", $first_name,$last_name, $email, $address, $customer_id);

    if ($stmt->execute()) {
        echo "Customer details updated successfully!";
        header("Location: ../controller/manage_customers.php");
        exit();
    } else {
        echo "Error updating customer details.";
    }
}
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
        <h2>Edit Customer</h2>
        <form method="POST">
            <input type="hidden" name="customer_id" value="<?php echo $customer['id']; ?>">

            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="<?php echo $customer['first_name']; ?>" required>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo $customer['last_name']; ?>" required>


            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $customer['email']; ?>" required>


            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo $customer['address']; ?>" required>

            <button type="submit">Update Customer</button>
        </form>

        <a href="../controller/manage_customers.php">Back to Manage Customers</a>
    </div>
</body>
</html>
