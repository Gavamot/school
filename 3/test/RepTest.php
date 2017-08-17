<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/Model/Rep.php';

use \PHPUnit\Framework\TestCase;

class RepTest extends TestCase
{
    const FNAME = __DIR__ . '/testfile.txt';
    const META_INFO = '"","firm","year","inv","value","capital"';

    private function getDataTemplate($i){
        return "{$i},firm#{$i},{$i},inv{$i},val{$i}, capital{$i}";
    }

    protected function setUp()
    {
        if(file_exists(RepTest::FNAME)) return;
        $f = fopen(RepTest::FNAME, 'w');
        fwrite($f, RepTest::META_INFO);
        for($i = 0; $i < 10; $i++)
            fwrite($f, "\r\n" . $this->getDataTemplate($i));
        fclose($f);
    }

    protected function tearDown()
    {
        if(!file_exists(RepTest::FNAME)) return;
        unlink(RepTest::FNAME);
    }

    public function testGetHeaders(){
        $actual = explode(',', RepTest::META_INFO);
        $rep = new Rep(RepTest::FNAME);
        $this->assertEquals($actual, $rep->getHeaders());
        $this->assertEquals($actual, $rep->getHeaders()); // Проверка кэша
    }

    public function testLoad(){
        $rep = new Rep(RepTest::FNAME);
        $actual = [];
        for($i = 0; $i < 10; $i++)
            array_push($actual, $this->getDataTemplate($i));
        $rep->load();
        $this->assertEquals($actual, $rep->buf);
    }


}