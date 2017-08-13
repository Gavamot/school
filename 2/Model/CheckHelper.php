<?php

namespace Model;

class CheckHelper
{
    public static function rangeLen($str, $min, $max){
        $len = mb_strlen($str);
        if($len < $min)
            throw new \InvalidArgumentException("Field length shoot be more {$min} symbols");
        if($len > $max)
            throw new \InvalidArgumentException("Field length shoot be short {$max} symbols");
    }
}