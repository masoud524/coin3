<?php

$symbol_id = 'BITSTAMP_SPOT_BTC_USD'; // Replace with the desired symbol ID
$period_id = '1DAY'; // Replace with the desired period, e.g., '5SEC', '2MTH'
$limit = 720; // Set the limit, default is 100
$include_empty_items = false; // Include items with no activity, true or false

$url = 'https://rest.coinapi.io/v1/ohlcv/' . $symbol_id . '/latest';
$url .= '?period_id=' . $period_id . '&limit=' . $limit . '&include_empty_items=' . ($include_empty_items ? 'true' : 'false');

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
    'Accept: application/json', // Changed to application/json for easier handling in PHP
    'X-CoinAPI-Key: 068a1df9-b93a-41ed-85a9-2094a3d26e18'
  ),
));

$response = curl_exec($curl);

if (curl_errno($curl)) {
    echo 'Error:' . curl_error($curl);
} else {
    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($httpcode == 200) {
        $data = json_decode($response, true);
        echo '<pre>' . print_r($data, true) . '</pre>';
    } else {
        echo "HTTP Code: $httpcode\n";
        echo "Response: $response\n";
    }
}

curl_close($curl);
?>
