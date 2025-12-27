<?php
$zipFileName = 'data.zip'; // نام فایل ZIP که می‌خواهید ایجاد کنید
$folderToZip = 'data'; // مسیر پوشه‌ی مورد نظر برای فشرده‌سازی
$downloadLink = 'https://aqubit.ir/' . $zipFileName; // لینک دانلود

// ایجاد یک شیء از کلاس ZipArchive
$zip = new ZipArchive();

// باز کردن فایل ZIP برای نوشتن
if ($zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
    // افزودن محتویات پوشه به فایل ZIP
    $filesToAdd = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($folderToZip),
        RecursiveIteratorIterator::LEAVES_ONLY
    );

    foreach ($filesToAdd as $file) {
        if (!$file->isDir()) {
            $filePath = $file->getRealPath();
            $relativePath = substr($filePath, strlen($folderToZip) + 1);
            $zip->addFile($filePath, $relativePath);
        }
    }

    // بستن فایل ZIP
    $zip->close();

    echo 'پوشه با موفقیت به فایل ZIP تبدیل شد: <a href="' . $downloadLink . '">دانلود فایل ZIP</a>';
} else {
    echo 'خطا در ایجاد فایل ZIP';
}
?>
