<?php
require __DIR__ . '/vendor/autoload.php';
use PolygonIO\Rest\Rest;

$rest = new Rest('EUqYavH74E0ZkIELa1rfMlN01RLU8tN5');

print_r($rest->crypto()->historicCryptoTrade()->get('BTC','USD', 10));

//https://api.polygon.io/v2/aggs/ticker/AAPL/range/1/day/2020-01-09/2024-01-09?apiKey=EUqYavH74E0ZkIELa1rfMlN01RLU8tN5
//https://api.polygon.io/v2/aggs/ticker/X:BTCUSD/range/1/day/2023-01-09/2023-01-09?apiKey=EUqYavH74E0ZkIELa1rfMlN01RLU8tN5
//minute day second hour
//https://polygon.io/docs/