<?php
// شروع یا ادامه‌ی سشن
session_start();

// اتصال به دیتابیس (باید به شکلی باشد که اطلاعات دیتابیس شما را بخواند)
$servername = "localhost"; // میزبان دیتابیس
$username = "aqubit_aqu"; // نام کاربری دیتابیس
$password = "Zfc2ajoUQ1ep75"; // رمز عبور دیتابیس
$dbname = "aqubit_aqu"; // نام دیتابیس

// اتصال به دیتابیس
$conn = new mysqli($servername, $username, $password, $dbname);

// بررسی اتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// بررسی اطلاعات ورودی از فرم
if(isset($_POST["username"]) && isset($_POST["password"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    // کوئری احراز هویت
    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // اگر احراز هویت موفقیت‌آمیز بود، اطلاعات کاربر را در سشن ذخیره می‌کنیم
        $_SESSION["username"] = $username;

        // می‌توانید به هوم پیج ریدایرکت کنید
        header("Location: /");
        exit;
    } else {
        echo "Invalid username or password";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        * {
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    width: 100%;
    max-width: 400px;
    padding: 20px;
}

.form-login {
    background: #f9f9f9;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

input {
    width: 100%;
    margin-bottom: 10px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    width: 100%;
    padding: 10px;
    background: #3498db;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
    </style>
</head>
<body>
    <div class="container">
        <form id="login.php" class="form-login" method="POST">
            <h2>Login Form</h2>
            <input type="text" id="username" name="username" placeholder="Username">
            <input type="password" id="password" name="password" placeholder="Password">
            <button type="submit">Login</button>
        </form>
    </div>

</body>
</html>