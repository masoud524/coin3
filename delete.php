<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    require_once('connect.php');

    $settingId = $_GET["id"];

    // Delete the record from the settings table
    $deletedRows = $connection->deleteRecord("settings", "id=".$settingId);

    if ($deletedRows > 0) {
        echo "Setting deleted successfully.";
        header("Location: settings.php"); // در صورتی که کاربر وارد نشده باشد، به صفحه‌ی لاگین ریدایرکت می‌شود
        exit;
    } else {
        echo "Error deleting setting.";
    }
} else {
    echo "Invalid request.";
}
?>
