<?php

require __DIR__ . 'vendor/autoload.php';

class Z1Test extends PHPUnit_Framework_TestCase
{
    public function testEmpty(){
        $this->assertEquals(4, 2+2);
    }
}