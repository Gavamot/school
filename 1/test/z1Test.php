<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../z1.php';
use \PHPUnit\Framework\TestCase;

class Z1Test extends TestCase
{
    public function testWrongArgumentsCountThrowsInvalidArgumentException(){
        $this->expectException(InvalidArgumentException::class);
        findRepeatStr("ggg ff");
    }

    public function testWrongArgumentsLengthThrowsInvalidArgumentException(){
        $this->expectException(InvalidArgumentException::class);
        $longStr = str_repeat("longString", 200);
        findRepeatStr("ggg ff " . $longStr);
    }

    public function testNotFound(){
        $this->assertEquals( findRepeatStr("asd ggg ggg"), "" );
    }

    public function testSimple(){
        $this->assertEquals( findRepeatStr("abcabc abc abcabcabc"), "abc" );
        $this->assertEquals( findRepeatStr("abababab abab abababababab"), "abab" );
        $this->assertEquals( findRepeatStr("gggggggg gggg ggggg"), "g" );
    }
}
