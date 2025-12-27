<?php
session_start();

// بررسی اینکه آیا کاربر وارد شده است یا خیر
if(isset($_SESSION["username"])){
    $username = $_SESSION["username"];
} else {
    header("Location: login.php"); // در صورتی که کاربر وارد نشده باشد، به صفحه‌ی لاگین ریدایرکت می‌شود
    exit;
}?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Application</title>
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
    max-width: 800px;
    margin: 2rem auto;
    padding: 0 1rem;
}

.row {
    display: flex;
}

.app {
    flex: 1;
    text-decoration: none;
    color: #333;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 1rem;
    margin-right: 1rem;
    display: flex;
    flex-direction: column;
}

.app:last-child {
    margin-right: 0;
}

h2 {
    margin-bottom: 0.5rem;
}

p {
    font-size: 0.8rem;
}
    </style>
</head>

<body>
    <header>
        <h1>Web Application</h1>
    </header>
    
    <div class="container">
        <div class="row">
            <a href="chanage.php" class="app">
                <h2>Change Password</h2>
                <p>App description here...</p>
            </a>
            <a href="settings.php" class="app">
                <h2>Change Settings</h2>
                <p>App description here...</p>
            </a>
        </div>
        <div class="row">
            <a href="apis.php" class="app">
                <h2>api settings</h2>
                <p>manage api settings here...</p>
            </a>
            <a href="#" class="app">
                <h2>none</h2>
                <p>coin api here...</p>
            </a>
        </div>
        <div class="row">
            <a href="all.php" class="app">
                <h2>Cryptocurrency</h2>
                <p>App description here...</p>
            </a>
            <a href="/zip.php" class="app">
                <h2>Receive Data</h2>
                <p>App description here...</p>
            </a>
        </div>
        <div class="row">
            <a href="#" class="app">
                <h2>Reset Data</h2>
                <p>App description here...</p>
            </a>
            <a href="#" class="app">
                <h2>Telegram Data</h2>
                <p>App description here...</p>
            </a>
        </div>
                <div class="row">
            <a href="/logout.php" class="app">
                <h2>Logout</h2>
                <p>Click here to log out...</p>
            </a>
            <a href="/list.php" class="app">
                <h2>refresh data</h2>
                <p>get and filter all data</p>
            </a>
        </div>
    </div>

    <script src="scripts.js"></script>
</body>

</html>