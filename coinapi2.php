<?php
require_once('vendor/autoload.php'); // Ensure you have SimpleXLSXGen installed

// Ensure $coi is defined with appropriate data before usage
$name = $coi->symbol;

$dir = '39';
$name = 'BTC';
$symbol_id = 'BITSTAMP_SPOT_' . $name . '_USD';
$period_id = '1HRS';
$limit = 720;
$include_empty_items = false;

$url = 'https://rest.coinapi.io/v1/ohlcv/' . $symbol_id . '/latest';
$url .= '?period_id=' . $period_id . '&limit=' . $limit . '&include_empty_items=' . ($include_empty_items ? 'true' : 'false');
$listapi = ['068a1df9-b93a-41ed-85a9-2094a3d26e18', 'a8fe1b73-12f8-4d9d-9423-50320901cd9c'];

$coin = [['start', 'end', 'topen', 'tclose', 'open', 'high', 'low', 'close', 'trades_count', 'volume']];

$excelDir = 'data/excel/' . $dir;
$jsonDir = 'data/json/' . $dir;

if (!is_dir($excelDir)) {
    mkdir($excelDir, 0777, true);
}

if (!is_dir($jsonDir)) {
    mkdir($jsonDir, 0777, true);
}

$i = 0;
$httpcode = 0;

while ($i < count($listapi) && $httpcode != 200) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Accept: application/json',
            'X-CoinAPI-Key: ' . $listapi[$i]
        ),
    ));

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        echo 'Error:' . curl_error($curl);
    } else {
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($httpcode == 200) {
            $data = json_decode($response, true);
            foreach ($data as $arr) {
                $coin[] = [
                    $arr['time_period_start'],
                    $arr['time_period_end'],
                    $arr['time_open'],
                    $arr['time_close'],
                    $arr['price_open'],
                    $arr['price_high'],
                    $arr['price_low'],
                    $arr['price_close'],
                    $arr['trades_count'],
                    $arr['volume_traded']
                ];
            }
        } else {
            echo "HTTP Code: $httpcode\n";
            echo "Response: $response\n";
        }
    }

    curl_close($curl);
    $i++;
}

if (!empty($coin)) {
    $timestamp = date('Y-m-d-H');
    $jsonFilename = $jsonDir . '/' . $name . '-' . $timestamp . '.json';
    file_put_contents($jsonFilename, json_encode($coin, JSON_PRETTY_PRINT));

    $excelFilename = $excelDir . '/' . $name . '-' . $timestamp . '.xlsx';
    $xlsx = Shuchkin\SimpleXLSXGen::fromArray($coin, 'All Trades');
    $xlsx->saveAs($excelFilename);

    echo "Data saved to $jsonFilename and $excelFilename\n";
} else {
    echo "No data to save.\n";
}

?>
