<?php 
$a =file_get_contents('data/BTC.json');
$coin= json_decode($a)->results;
foreach($coin as $coi){
   print_r($coi);
   echo'</br>';
}