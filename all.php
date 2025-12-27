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
    $data = json_decode(file_get_contents('list.json'), true);
    ?>
</br>
    <div class="container">
        <table>
            <tr>
                <th>نماد</th>
                <th>قیمت</th>
                <th>حجم 24 ساعته</th>
                <th>تغییر در 24 ساعت اخیر</th>
                <th>تغییرات ساعتی</th>
                <th>تغییرات هفتگی</th>
                <th>تغییرات ماهانه</th>
                <th>تغییرات سه ماهه</th>
            </tr>
            <?php foreach ($data['data'] as $coi) : ?>
                <tr>
                    <td><a href="./show.php?n=<?php echo $coi['symbol']; ?>"><?php echo $coi['symbol']; ?></a></td>
                    <td><?php echo $coi['quote']['USD']['price']; ?></td>
                    <td><?php echo $coi['quote']['USD']['volume_24h']; ?></td>
                    <td><?php echo isset($coi['quote']['USD']['percent_change_24h']) ? $coi['quote']['USD']['percent_change_24h'] : 'ناموجود'; ?></td>
                    <td><?php echo isset($coi['quote']['USD']['percent_change_1h']) ? $coi['quote']['USD']['percent_change_1h'] : 'ناموجود'; ?></td>
                    <td><?php echo isset($coi['quote']['USD']['percent_change_7d']) ? $coi['quote']['USD']['percent_change_7d'] : 'ناموجود'; ?></td>
                    <td><?php echo isset($coi['quote']['USD']['percent_change_30d']) ? $coi['quote']['USD']['percent_change_30d'] : 'ناموجود'; ?></td>
                    <td><?php echo isset($coi['quote']['USD']['percent_change_90d']) ? $coi['quote']['USD']['percent_change_90d'] : 'ناموجود'; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>
