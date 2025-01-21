<?php
include '../database/config.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_loan_status'])) {
    $loan_id = $_POST['loan_id'];
    $loan_status = $_POST['loan_status'];

    $stmt = $conn->prepare("UPDATE loans SET loan_status = ? WHERE id = ?");
    $stmt->bind_param("si", $loan_status, $loan_id);
    if ($stmt->execute()) {
        echo "Loan status updated successfully!";
    } else {
        echo "Error updating loan status.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Services</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Loan Services</h2>
        <form method="POST">
            <label for="loan_id">Loan ID:</label>
            <input type="number" id="loan_id" name="loan_id" required>

            <label for="loan_status">Loan Status:</label>
            <select id="loan_status" name="loan_status">
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
            </select>

            <button type="submit" name="update_loan_status">Update Loan Status</button>
        </form>

        <a href="../view/dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
