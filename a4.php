<?php

foreach ($records as $record) {
    $siteKey = $record["siteKey"]; // Assuming the column name is "site_key"
    $time = $record["timePeriod"]; // Assuming the column name is "time_period"
    $number = $record["number"]; // Assuming the column name is "time_period"

    $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
    $parameters = [
        'start' => '1',
        'limit' => $number,
        'convert' => 'USD'
    ];

    $headers = [
        'Accepts: application/json',
        'X-CMC_PRO_API_KEY: ' . $siteKey
    ];

    $qs = http_build_query($parameters); // Query string encode the parameters
    $request = "{$url}?{$qs}"; // Create the request URL

    $curl = curl_init(); // Initialize cURL session
    curl_setopt_array($curl, [
        CURLOPT_URL => $request,            // Set the request URL
        CURLOPT_HTTPHEADER => $headers,     // Set the headers 
        CURLOPT_RETURNTRANSFER => 1         // Return the response as a string
    ]);

    $response = curl_exec($curl); // Send the request and store the response
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE); // Get the HTTP response code
    curl_close($curl); // Close cURL session

    // Check the HTTP response code
    if ($httpCode == 200) {
        file_put_contents("list.json", $response); // Save the response to a file
        break; // Exit the loop if the request is successful
    } else {
        echo "Error fetching data for time period: {$timePeriod}. HTTP Code: {$httpCode}";
        // You can handle this error as needed, such as logging it or notifying the user
    }
}
?>
