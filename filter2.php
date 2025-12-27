<?php
require_once('vendor/autoload.php');
$apis = $connection->readRecords("addapi");

// Ensure $coi is defined with appropriate data before usage
$name = $coi->symbol;

$crypto = null;
$bitt = null;
$i=0;
while ($bitt == null && $i < count($apis)) {
    $crypto = file_get_contents('https://min-api.cryptocompare.com/data/v2/histohour?fsym='.$name.'&tsym=USD&limit=720&aggregate=1&e=CCCAGG&api_key='.$apis[0]["api"]);
    $bitt = file_get_contents('https://min-api.cryptocompare.com/data/v2/histohour?fsym=BTC&tsym=USD&limit=720&aggregate=1&e=CCCAGG&api_key='.$apis[0]["api"]);
    $i++;
}
if ($crypto !== false) {
    $arr = json_decode($crypto)->Data->Data;
    $bit = json_decode($bitt)->Data->Data;

    // Remove associative keys, keeping only values
    $values = [];
    $head=['زمان','بالا','پایین','بازشدن','حجم','ارزش','بستن','تبدیل','شبکه مبدل','زمان','بالا','پایین','بازشدن','حجم','ارزش','بستن','تبدیل'];
    array_push($values, $head);
    $i=0;
    foreach ($arr as $array) {
        $dat = [];
        $i++;
        $bita = $bit[$i];
        foreach ($array as $key => $val) {
            array_push($dat, $val);
        }
        foreach ($bita as $key => $valh) {
            array_push($dat, $valh);
        }
        array_push($values, $dat);
    }

    // Save as JSON
    $jsonDir = 'public_html/data/json/'.$dir;
    if (!is_dir($jsonDir)) {
        mkdir($jsonDir, 0777, true); // Create the directory if it doesn't exist recursively
    }

    $jsonFilename = $jsonDir . '/' . $name .'-'. $coi->quote->USD->percent_change_7d . date('Y-m-d-H') . '.json';
    if (!file_exists($jsonFilename)) {
        file_put_contents($jsonFilename, json_encode($arr));
    }

    // Save as Excel
    $excelDir = 'public_html/data/excel/'.$dir;
    if (!is_dir($excelDir)) {
        mkdir($excelDir, 0777, true); // Create the directory if it doesn't exist recursively
    }

    $excelFilename = $excelDir . '/' . $name .'-'. $coi->quote->USD->percent_change_7d .'-'. date('Y-m-d-H') .'.xlsx';
    if (!file_exists($excelFilename)) {
        $xlsx = Shuchkin\SimpleXLSXGen::fromArray($values, 'all trade');
        $xlsx->saveAs($excelFilename);
    }
} else {
    echo "Failed to fetch data for {$name}\n";
}
?>
