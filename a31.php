<?php
$cry = file_get_contents('list.json');
$cryp = json_decode($cry)->data;

$time = 'hour';
$n=0;

foreach ($cryp as $crypt) {
    if ($n >= 1) {
        break; // Exit the loop if the counter exceeds 100
    }
    $allcoin = [];
    for($i=0;$i<10;$i++){
        $hours_ago = $i*83;
        $hours_ago_az =$hours_ago+83;
        $az = date('Y-m-d', strtotime("-{$hours_ago_az} hours"));
        $ta = date('Y-m-d', strtotime("-{$hours_ago} hours")); // Now
        $crypto = file_get_contents("https://api.polygon.io/v2/aggs/ticker/X:{$crypt->symbol}USD/range/1/{$time}/{$az}/{$ta}?apiKey=EUqYavH74E0ZkIELa1rfMlN01RLU8tN5");
        if ($crypto !== false) {
            array_push($allcoin, json_decode($crypto)->results);
            $a = json_decode($crypto)->next_url;
   

        } else {
            echo "Failed to fetch data for {$crypt->symbol}\n";
        }

    }
    
        $filename = 'data/' . $crypt->symbol . '.json';
        file_put_contents($filename, json_encode($allcoin));    
 
    $n++;
}
?>
