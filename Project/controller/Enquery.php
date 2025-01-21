<?php
session_start();
include '../database/config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'maker') {
    header("Location: ../auth/login.php");
    exit();
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

<h2>Customer Enquery</h2>

<table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Status</th>
  </tr>
  <?php
  if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        ?>
         <tr>
    <td><?php echo $row["id"] ?></td>
    <td><?php echo $row["name"] ?></td>
    <td><?php echo $row["status"] ?></td>
    
  </tr>
        <?php
        // echo "ID: " . $row["Id"]. " - Name: " . $row["Name"]. "<br>";
    }
} else {
    echo "0 results";
}
  ?>
 
  
</table>

</body>
</html>

