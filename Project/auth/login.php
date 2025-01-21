<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
      <link rel="stylesheet" href="../style/style.css">
     <script>
        // JavaScript Form Validation
        function validateLoginForm(event) {
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value.trim();

            if (!username) {
                alert('Username is required.');
                event.preventDefault();
                return false;
            }

            if (!password) {
                alert('Password is required.');
                event.preventDefault();
                return false;
            }
            return true;
        }
    </script>

    
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="../controller/login_action.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
