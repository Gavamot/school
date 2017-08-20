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
    for($i = 0; $i< $argsCount; $i++)
        TimePoint::addIntervalPointsToArray($args[$i], $points);
    array_multisort(array_map('sortIntervalsByEnd', $points), $points);
    var_dump($points);
    return "0 -";
}

function sortIntervalsByEnd(Interval $interval1, Interval $interval2){
    return $interval1->end->compare($interval2->end);
}

class TimePoint{

    public $time;
    public $sign; 
    public function __construct($str, $sign)
    {
        $time =  preg_split(':', $str);
        $this->time = (int)$time[0] * 60 + (int)$time[1];
        $this->sign = $sign;
    }

    public static function addIntervalPointsToArray($timeStr, &$array) : void{
        var_dump($timeStr);
        $time =  preg_split('-', $timeStr);
        $b = new Time($time[0], true);
        $e = new Time($time[1], false);
        array_push($array, $b);
        array_push($array, $e);
    }
    public function compare($t) : int
    {
        if($this->time > $t->time) return 1;
        else if($this->time < $t->time) return -1;
        return 0;
    }
    
}