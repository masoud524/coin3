<?php
$name=$_REQUEST['n'];

$time = 'hour';
$n=0;

    $allcoin = [];
    for($i=0;$i<10;$i++){
        $hours_ago = $i*83;
        $hours_ago_az =$hours_ago+83;
        $az = date('Y-m-d', strtotime("-{$hours_ago_az} hours"));
        $ta = date('Y-m-d', strtotime("-{$hours_ago} hours")); // Now
        $crypto = file_get_contents('https://api.polygon.io/v2/aggs/ticker/X:'.$name.'USD/range/1/'.$time.'/'.$az.'/'.$ta.'?apiKey=EUqYavH74E0ZkIELa1rfMlN01RLU8tN5');
        if ($crypto !== false) {
            echo json_decode($crypto)->status;
            $pags =json_decode($crypto)->results;
            $pag = array_reverse($pags);
            foreach($pag as $his){
                $dat=$his->t;
                $allcoin[$dat]=$his;
            }
        } else {
            echo "Failed to fetch data for {$name}\n";
        }

    }
        $filename = 'data/' . $name . '.json';
        file_put_contents($filename, json_encode($allcoin));
 
?>
