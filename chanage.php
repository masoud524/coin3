<?php
// Start or resume the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connection to the database

    $servername = "localhost"; // میزبان دیتابیس
    $username = "aqubit_aqu"; // نام کاربری دیتابیس
    $password = "Zfc2ajoUQ1ep75"; // رمز عبور دیتابیس
    $dbname = "aqubit_aqu"; // نام دیتابیس

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $oldp = $_POST["current-password"];
    $newp = $_POST["new-password"];
    $conp = $_POST["confirm-password"];
    $username = $_SESSION["username"];

    // Check if new password and confirm password match
    if ($newp == $conp) {
        // کوئری احراز هویت
        $sql = "SELECT * FROM admin WHERE username='$username' AND password='$oldp'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Hash the new password
            $newHashedPassword = password_hash($newp, PASSWORD_DEFAULT);

            // Update the password in the database
            $sql = "UPDATE admin SET password='$newp' WHERE username='$username'";

            if ($conn->query($sql) === TRUE) {
                echo "Password updated successfully!";
            } else {
                echo "Error updating password: " . $conn->error;
            }
        } else {
            echo "Invalid current password.";
        }
    } else {
        echo "New password and confirm password do not match.";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <style>
    * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
}

header {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 1rem 0;
}

.container {
    max-width: 600px;
    margin: 2rem auto;
    padding: 0 1rem;
}

label,
input {
    display: block;
    margin-bottom: 1rem;
}

input {
    width: 100%;
    padding: 0.5rem;
    font-size: 1rem;
}

button {
    padding: 0.5rem 1rem;
    background-color: #333;
    color: white;
    border: none;
    cursor: pointer;
} 
    </style>
</head>

<body>
    <header>
        <h1>Change Password</h1>
    </header>
    
    <div class="container">
        <form id="change-password-form" method="POST">
            <label for="current-password">Current Password:</label>
            <input type="password" id="current-password" name="current-password">
            
            <label for="new-password">New Password:</label>
            <input type="password" id="new-password" name="new-password">
            
            <label for="confirm-password">Confirm New Password:</label>
            <input type="password" id="confirm-password" name="confirm-password">
            
            <button type="submit">Change Password</button>
        </form>
    </div>

    <script src="scripts.js"></script>
</body>

</html>