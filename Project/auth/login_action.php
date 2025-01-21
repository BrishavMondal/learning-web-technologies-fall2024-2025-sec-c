<?php
include '../database/config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($password==$user['password']) {
            // Password is correct
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
        if('admin'==$user['role']){
            header("Location: ../View/dashboard.php");
        }elseif('maker'==$user['role']){
            header("Location: ../View/maker.php");
        }elseif('checker'==$user['role']){
            header("Location: /View/checker.php");
        }
        } 
        else {
            echo "Invalid password!";
        }
    } else {
        // No user found
        echo "No user found with that username.";
    }
}
?>