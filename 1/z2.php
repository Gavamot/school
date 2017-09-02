<?php
/** Задача 2.
    В музее регистрируется в течение дня время прихода и ухода каждого посетителя.
     Таким образом за день получены N пар значений, где первое значение в паре показывает
     время прихода посетителя и второе значения - время его ухода. Найти промежуток времени,
     в течение которого в музее одновременно находилось максимальное число посетителей.
    Входные данные, время прихода/ухода каждого посетителя: 10:30-11:30 11:00-16:30 11:20-12:30
    Выходные данные, максимальное число посетителей и промежуток времени: 3 11:00-11:30
 **/

function getMaxInterval(string $input) : string{
    if($input == "") return "0 -";
    $args = preg_split('/\s+/', $input);
    $argsCount = count($args);
    $points = [];
    for($i = 0; $i< $argsCount; $i++){
        $time =  preg_split("/-/", $args[$i]);
        array_push($points, new TimePoint($time[0], true));
        array_push($points, new TimePoint($time[1], false));
    }
    array_multisort(array_map('sortIntervalsByEnd', $points), $points);
    $count = 0; $maxCount = 0; $start = 0; $end = 0;
    for($i = 0, $max = $argsCount * 2; $i< $max; $i++){
        $p = $points[$i];
        if($p->sign) $count++;
        else $count--;
        if($count > $maxCount){
            $maxCount = $count;
            //if($p->sign && $start == 0) $start = $p->time;
            //else $end = $p->$time;
        }
    }
    //$start = TimePoint::timeToString($start);
    //$end = TimePoint::timeToString($end);
    return "{$maxCount} {$start}-{$end}";
}

function sortIntervalsByEnd(TimePoint $p1){
    return $p1->time;
}

class TimePoint{

    public $time;
    public $sign; 
    public function __construct($str, $sign)
    {
        $time =  preg_split("/:/", $str);
        $this->time = (int)$time[0] * 60 + (int)$time[1];
        $this->sign = $sign;
    }

    public static function timeToString(int $time){
        $h = (int)($time / 60);
        $m = $time - $h * 60;
        return $h . ':' . $m;
    }
}