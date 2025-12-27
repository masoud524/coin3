<?php
$cry = file_get_contents('list.json');
$cryp = json_decode($cry)->data;

$time = 'hour';
$hours_ago = 720;
$az = date('Y-m-d', strtotime("-{$hours_ago} hours"));
$ta = date('Y-m-d'); // Now
$n=0;

foreach ($cryp as $crypt) {
    if ($n >= 1) {
        break; // Exit the loop if the counter exceeds 100
    }
    $allcoin = [];
    $crypto = file_get_contents("https://api.polygon.io/v2/aggs/ticker/X:{$crypt->symbol}USD/range/1/{$time}/{$az}/{$ta}?apiKey=EUqYavH74E0ZkIELa1rfMlN01RLU8tN5");
    
    if ($crypto !== false) {
        array_push($allcoin, json_decode($crypto)->results);
        $a = json_decode($crypto)->next_url;
        
        while (isset($a)) {
            $crypto = file_get_contents($a . '&apiKey=EUqYavH74E0ZkIELa1rfMlN01RLU8tN5');
            array_push($allcoin, json_decode($crypto)->results);
            $a = json_decode($crypto)->next_url;    
        }

        $filename = 'data/' . $crypt->symbol . '.json';
        file_put_contents($filename, json_encode($allcoin));
    } else {
        echo "Failed to fetch data for {$crypt->symbol}\n";
    }
    $n++;
}
?>
