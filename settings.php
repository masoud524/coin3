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
    box-sizing: border-box;

}


        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }

        th,
        td {
            padding: 0.5rem;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        a {
            text-decoration: none;
            color: #333;
        }

        a:hover {
            text-decoration: underline;
        }

        @media screen and (max-width: 600px) {
            table {
                overflow-x: auto;
                display: block;
            }

            th,
            td {
                white-space: nowrap;
            }
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

label,
input,
textarea,
select {
    display: block;
    margin-bottom: 1rem;
}

input,
textarea,
select{
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
        <h1>Site Settings</h1>
    </header>
    <?php
    session_start();

    // Check if the user is logged in
    if(isset($_SESSION["username"])){
        $username = $_SESSION["username"];
        echo "Welcome, $username! <a href='logout.php'>Logout</a>";

        // Include the database connection file
        require_once('connect.php');

        // Read records from the settings table
        $records = $connection->readRecords("settings");
?>
 <table id="records">
            <thead>
                <tr>
                    <th>Site Key</th>
                    <th>Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($records as $record) {
                    echo '<tr>';
                    echo '<td>' . $record["siteKey"] . '</td>'; // Assuming the column name is "site_key"
                    echo '<td>' . $record["number"] . '</td>'; // Assuming the column name is "site_key"
                    echo '<td>' . $record["timePeriod"] . '</td>'; // Assuming the column name is "site_key"
                    echo '<td><a href="delete.php?id=' . $record["id"] . '">Delete</a></td>'; // Link to delete.php with record ID
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
<?php
        // Handle form submission for adding new settings
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $siteKey = $_POST["key"];
            $number = $_POST["number"];
            $timePeriod = $_POST["time-period"];

            // Insert new record into the settings table
            $newRecordId = $connection->createRecord("settings", ["siteKey" => $siteKey ,"number" => $number , "timePeriod" => $timePeriod]);

            if ($newRecordId) {
                echo "New setting added successfully.";
            } else {
                echo "Error adding setting.";
            }
        }
    } else {
        header("Location: login.php");
        exit;
    }
    ?>

    <div class="container">
        <form id="settings-form" action="settings.php" method="post"> <!-- Change action to point to the current file -->
            <label for="site-key">Site key:</label>
            <textarea id="site-key" name="key"></textarea>
            
            <label for="number">number:</label>
            <input name="number" type="number">

            <label for="time-period">Time Period:</label>
            <select id="time-period" name="time-period">
                <option value="percent_change_24h">Daily</option>
                <option value="percent_change_7d">Weekly</option>
                <option value="percent_change_30d">Monthly</option>
            </select>
            
            <button type="submit">Save Settings</button>
        </form>
    </div>
</body>

</html>
