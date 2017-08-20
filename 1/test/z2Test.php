<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../z2.php';
use \PHPUnit\Framework\TestCase;

class Z2Test extends TestCase
{
    public function testEmpty(){
        $this->assertEquals( getMaxInterval(""), "0 -" );
    }

    public function testSimple(){
        $this->assertEquals( getMaxInterval("10:30-11:30 11:00-16:30 11:20-12:30"), "3 11:00-11:30" );
        $this->assertEquals( getMaxInterval("10:30-11:30"), "1 10:30-11:30" );
        $this->assertEquals( getMaxInterval("10:30-11:30 11:00-16:30 11:20-12:30 12:20-13:00 13:20-15:00" ), "3 11:00-11:30");
    }
}
