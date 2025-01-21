<?php
include '../database/config.php';
session_start();


if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_password'])) {
    $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
    $admin_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
    $stmt->bind_param("si", $new_password, $admin_id);
    if ($stmt->execute()) {
        echo "Password changed successfully!";
    } else {
        echo "Error changing password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Management</title>
    <link rel="stylesheet" href="../style/style.css">
    
</head>
<body>
    <div class="dashboard-container">
        <h2>Change Admin Password</h2>
        <form method="POST">
            <label for="new_password">Current
            Password:</label>
            <input type="Text" id="" name="" required>

             <label for="new_password">New Password:</label>
            <input type="Text" id="" name="" required>

             <label for="new_password">Confirm New Password:</label>
            <input type="Text" id="new_password" name="new_password" required>

            <button type="submit" name="change_password">Change Password</button>
        </form>

        <a href="../View/dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
