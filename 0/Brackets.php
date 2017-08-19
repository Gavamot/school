<?php

class Brackets
{
	public function isBracketSequenceCorrect($str) 
	{
            $charts = ['{' => '}', '(' => ')','[' => ']' ];
            $stack = [];

            for($i = 0; $i < strlen($str); $i++)
            {
                $c = $str[$i];
                if(array_key_exists($c, $charts))
                    array_push($stack, $charts[$c]);
                if(in_array($c, $charts))
                    if (count($stack) === 0 || array_pop($stack) != $c) 
                        return false;
            }
            return count($stack) === 0;
	}
}


