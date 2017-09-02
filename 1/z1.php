<?php
/** Задача 1.
 * Даны три слова X,Y,Z. Определить, существует ли слово V такое,
 * что X,Y,Z являются повторениями слова V. Если V существует, то напечатать его.
 * Слова имеют длину не более 1000 символов. Символ "пробел" является разделителем слов.
 * Входные данные, три слова через пробел: abcabc abc abcabcabc
 * Выходные данные:  abc
 * */

/** Вернет пустую строку в случаи неудачного поиска
 * trows InvalidArgumentException */
function findRepeatStr(string $input) : string{
    $args = preg_split('/\s+/', $input);
    $argsCount = 3;
    if(count($args) != $argsCount)
        throw new InvalidArgumentException("неправильные входные данные");
    for($i = 0; $i < $argsCount; $i++)
        if(mb_strlen($args[$i]) > 1000)
            throw new InvalidArgumentException("слово № " . $i . " недопустимую длину");

    array_multisort(array_map('mb_strlen', $args), $args);
    $pattern = $args[0];
    array_splice($args, 0, 1);
    return _findRepeatStr($args, $pattern);
}

function _findRepeatStr($strArray, string $subStr) : string{
    if($subStr === '')
        return '';
    $isMatches = true;
    $pattern = "/^({$subStr})+$/";
    for($i = 0, $max = count($strArray); $i < $max; $i++){
        $isMatches = preg_match($pattern, $strArray[$i]);
        if(!$isMatches) break;
    }
    return $isMatches ? $subStr : _findRepeatStr($strArray, substr($subStr, 0, -1));
}
