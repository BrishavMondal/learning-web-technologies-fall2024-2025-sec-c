<?php
session_start();
include '../database/config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'maker') {
    header("Location: ../auth/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $balance = 0.00; 

    
    $sql = "INSERT INTO customers (first_name, last_name, email, address, password, balance) 
            VALUES ('$first_name', '$last_name', '$email', '$address', '$password', $balance)";

    if ($conn->query($sql) === TRUE) {
        echo "Account created successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Create Account</title>    
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}
        * {box-sizing: border-box; margin-left: 120px; margin-right: 120px; align-items: center;}
        input[type=text], input[type=email], input[type=password], textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
        }
        input[type=submit] {
            background-color: #04AA6D;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type=submit]:hover {
            background-color: #45a049;
        }
        .container {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
    <h3>Create Account</h3>
    <div class="container">
        <form method="POST">
            <label for="fname">First Name</label>
            <input type="text" id="fname" name="first_name" placeholder="Your name.." required>
            
            <label for="lname">Last Name</label>
            <input type="text" id="lname" name="last_name" placeholder="Your last name.." required>
            
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Email" required>
            
            <label for="address">Address</label>
            <input type="text" id="address" name="address" placeholder="Your address" required>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Your password" required>

            <input type="submit" value="Submit">
        </form>
        <a href="../View/maker.php">Back to Maker</a>
    </div>
</body>
</html>

