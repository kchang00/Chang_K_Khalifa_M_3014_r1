<?php

date_default_timezone_set ('EST');
$reqtime = date('Y-m-d H:i:s');
$dt = DateTime::createFromFormat("Y-m-d H:i:s", $reqtime);
$h = $dt->format('H');
$hours = (int)$h;

function redirect_to($location){
    if($location != null){
        header('Location:' .$location);
        // very important to include exit for security (after header - redirect)
        exit;
    }
}

function swap_date($time) {
    if($time <= 11){ // before or at 11 o'clock
        $greeting = ' Good Morning! ';
    }elseif($time <= 16){ // before or at 4 o'clock
        $greeting = ' Good Afternoon! ';
    }elseif($time <= 24){ // before or at 12 o'clock
        $greeting = ' Good Evening! ';
    }else{
        $greeting = ' Welcome ';
    }
    echo $greeting;
}