<?php
session_start();
session_unset(); // حذف تمام اطلاعات سشن
session_destroy(); // حذف سشن

header("Location: login.php"); // ریدایرکت به صفحه‌ی لاگین
exit;
?>
