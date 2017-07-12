<?php

class MaximumUniqueSubstring
{
    public function findMaximumUniqueSubstring($str) 
    {
        if(strlen($str) === 0) return "";
        $ves = [];
        $ln = count($str);
        for($i = 0; $i < $ln; $i++)
        {
            $substr = substr($str, $i, $ln - $i);
            $count = $this->countOfLength($substr);
            array_push($ves, $count);
        }
        
        $str = str_split($str);
        $charts = ['{' => '}', '(' => ')','[' => ']' ];
        $stack = [];

        for($i = 0; $i < count($str); $i++)
        {
          $c = $str[$i];
          if(array_key_exists($c, $charts))
                array_push($stack, $charts[$c]);
          if(in_array($c, $charts))
                if (count($stack) === 0 || array_pop($stack) != $c) 
                        return false;
        }
        return count($stack) == 0;
    }
    
    private function countOfLength($str){
        $exsist = [];
        $i = 0;
        for(; $i < strlen($str); $i++){
            if(in_array($str[$i], $exsist))
                break;
            array_push($exsist, $str[$i]);
        }
        return $i;
    }  
}


