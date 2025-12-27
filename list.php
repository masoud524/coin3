<?php
//connect to database
require_once('connect.php');
// Read records from the settings table
$records = $connection->readRecords("settings");


//get all data af coin market ap
require_once('a4.php');
$a = file_get_contents('list.json');
$coin = json_decode($a)->data;

?>

<table border="1">
    <tr>
        <th>نماد</th>
        <th>قیمت</th>
        <th>حجم 24 ساعته</th>
        <th>تغییر در 24 ساعت اخیر</th>
        <th>تغییرات ساعتی</th>
        <th>تغییرات هفتگی</th>
        <th>تغییرات ماهانه</th>
        <th>تغییرات سه ماهه</th>
    </tr>
    <?php foreach ($coin as $coi): ?>
        <tr>
            <td><a href="./his.php?n=<?php echo $coi->symbol; ?>"><?php echo $coi->symbol; ?></a></td>
            <td><?php echo $coi->quote->USD->price; ?></td>
            <td><?php echo $coi->quote->USD->volume_24h; ?></td>
            <td><?php echo $coi->quote->USD->percent_change_24h; ?></td>
            <td><?php echo isset($coi->quote->USD->percent_change_1h) ? $coi->quote->USD->percent_change_1h : 'ناموجود'; ?></td>
            <td><?php echo isset($coi->quote->USD->percent_change_7d) ? $coi->quote->USD->percent_change_7d : 'ناموجود'; ?></td>
            <td><?php echo isset($coi->quote->USD->percent_change_30d) ? $coi->quote->USD->percent_change_30d : 'ناموجود';
if(20 < $coi->quote->USD->$time && $coi->quote->USD->$time <= 30){
    $dir='20';
                //چک کنند ارز
                require('filter.php');
}elseif(30 < $coi->quote->USD->$time && $coi->quote->USD->$time <= 40){
    $dir='30';
                //چک کنند ارز
                require('filter.php');
}elseif(40 < $coi->quote->USD->$time && $coi->quote->USD->$time <= 50){
    $dir='40';
                //چک کنند ارز
                require('filter.php');
}elseif(50 < $coi->quote->USD->$time && $coi->quote->USD->$time <= 60){
    $dir='50';
                //چک کنند ارز
                require('filter.php');
}elseif(60 < $coi->quote->USD->$time && $coi->quote->USD->$time <= 70){
    $dir='60';
                //چک کنند ارز
                require('filter.php');
}elseif (70 < $coi->quote->USD->$time && $coi->quote->USD->$time <= 80){
    $dir='70';
                //چک کنند ارز
                require('filter.php');
}elseif (80 < $coi->quote->USD->$time && $coi->quote->USD->$time <= 90){
    $dir='80';
                //چک کنند ارز
                require('filter.php');
}elseif (90 < $coi->quote->USD->$time && $coi->quote->USD->$time <= 100){
    $dir='90';
                //چک کنند ارز
                require('filter.php');
}elseif (100 < $coi->quote->USD->$time && $coi->quote->USD->$time <= 120){
    $dir='100';
                //چک کنند ارز
                require('filter.php');
}elseif (120 < $coi->quote->USD->$time && $coi->quote->USD->$time <= 140){
    $dir='120';
                //چک کنند ارز
                require('filter.php');
}elseif (140 < $coi->quote->USD->$time && $coi->quote->USD->$time <= 160){
    $dir='140';
                //چک کنند ارز
                require('filter.php');
}elseif (160 < $coi->quote->USD->$time && $coi->quote->USD->$time <= 180){
    $dir='160';
                //چک کنند ارز
                require('filter.php');
}elseif (180 < $coi->quote->USD->$time && $coi->quote->USD->$time <= 200){
    $dir='180';
                //چک کنند ارز
                require('filter.php');
}elseif(200 < $coi->quote->USD->$time){
    $dir='200+';
                //چک کنند ارز
                require('filter.php');
}
            ?></td>
            <td><?php echo isset($coi->quote->USD->percent_change_90d) ? $coi->quote->USD->percent_change_90d : 'ناموجود'; ?></td>
        </tr>
    <?php endforeach; ?>
</table>
