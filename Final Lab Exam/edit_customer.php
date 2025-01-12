<?php
include 'connection.php';
session_start();


if (!isset($_SESSION['user_id'])) {
         header("Location: login.php");
    exit();
}


if (isset($_GET['id'])) {
    $customer_id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM employers WHERE id = ?");
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
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $stmt = $conn->prepare("UPDATE customers SET name = ?, email = ?, phone = ?, address = ? WHERE id = ?");
    $stmt->bind_param("sssii", $name, $email, $phone, $address, $customer_id);

    if ($stmt->execute()) {
        echo "Employer details updated successfully!";
        header("Location: manage_customers.php");
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
</head>
<body>
    <div class="dashboard-container">
        <h2>Edit Customer</h2>
        <form method="POST">
            <input type="hidden" name="customer_id" value="<?php echo $customer['id']; ?>">

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $customer['name']; ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $customer['email']; ?>" required>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="<?php echo $customer['phone']; ?>" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo $customer['address']; ?>" required>

            <button type="submit">Update Customer</button>
        </form>

        <a href="manage_customers.php">Back to Manage Customers</a>
    </div>
</body>
</html>
