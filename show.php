<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
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
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 0.5rem;
            text-align: center;
        }

        th {
            background-color: #333;
            color: white;
        }
    </style>
</head>

<body>
    <header>
        <h1>Site Settings</h1>
    </header>
    <?php
    session_start();

    // بررسی اینکه آیا کاربر وارد شده است یا خیر
    if (isset($_SESSION["username"])) {
        $username = $_SESSION["username"];
        echo "Welcome, $username! <a href='logout.php'>Logout</a>";
    } else {
        header("Location: login.php"); // در صورتی که کاربر وارد نشده باشد، به صفحه‌ی لاگین ریدایرکت می‌شود
        exit;
    }

    // بارگیری داده‌ها از فایل JSON
$name=$_REQUEST['n'];
require_once('his.php');
$a = file_get_contents('data/'.$name.'.json');
$page = json_decode($a);    
?>
</br>
    <div class="container">

<table border="1">
    <tr>
        <th>زمان</th>
        <th>حجم</th>
        <th>بازشدن</th>
        <th>پایین</th>
        <th>بالا</th>
        <th>بسته شدن</th>
    </tr>
        <?php foreach ($page as $time => $coin): ?>
            <tr>
                <td><?php echo date('Y-m-d H:i:s', $coin->t / 1000); ?></td>
                <td><?php echo $coin->v; ?></td>
                <td><?php echo $coin->o; ?></td>
                <td><?php echo $coin->l; ?></td>
                <td><?php echo $coin->h; ?></td>
                <td><?php echo $coin->c; ?></td>
            </tr>
        <?php endforeach; ?>
</table>
</div>
</body>
</html>