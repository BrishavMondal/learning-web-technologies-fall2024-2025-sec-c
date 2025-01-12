<?php
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employer_name = $_POST['employer_name'];
    $company_name = $_POST['company_name'];
    $contact_no = $_POST['contact_no'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "INSERT INTO employers (employer_name, company_name, contact_no, username, password) VALUES ('$employer_name', '$company_name', '$contact_no', '$username', '$password')";

    if (mysqli_query($conn, $query)) {
        echo "Employer registered successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
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
<form method="POST">
    <input type="text" name="empolyer_name" placeholder="Empolyer name" required>
    <input type="text" name="company_name" placeholder="Company name" required>
    <input type="text" name="contact_no" placeholder="Contact No" required>
    <input type="text" name="username" placeholder="User Name" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Register</button>
     <a href="manage_customers.php">Go to Dashboard </a>
</form>
</body>
</html>