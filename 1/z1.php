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



    return "";
}
