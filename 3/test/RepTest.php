<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/Model/Rep.php';

use \PHPUnit\Framework\TestCase;

class RepTest extends TestCase
{
    const FNAME = __DIR__ . '/testfile.txt';
    const META_INFO = '"","firm","year","inv","value","capital"';

    public function getMethod($class, $name)
    {
        $class = new ReflectionClass($class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }

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
        for($i = 0; $i < 10; $i++){
            array_push($actual, $rep->strToArray($this->getDataTemplate($i)) );
        }

        $rep->load();
        $this->assertEquals($actual, $rep->buf);
    }

    public function testSave(){
        $rep1 = new Rep(RepTest::FNAME);
        $rep2 = new Rep(RepTest::FNAME . 2);
        $rep2->meta = $rep1->getHeaders();
        $rep2->buf = $rep1->buf;
        $rep2->save();
        $rep3 = new Rep(RepTest::FNAME . 2);
        $rep3->load();
        $this->assertEquals($rep1->getHeaders(), $rep3->getHeaders());
        $this->assertEquals($rep1->buf, $rep3->buf);
        unlink(RepTest::FNAME . 2);
    }

    public function testAddRow(){
        $rep = new Rep(RepTest::FNAME);
        $arr = array(1,2,3);
        $rep->addRow($arr);
        $this->assertEquals($rep->buf[0], $arr);
    }

    public function testUpdateRow(){
        $rep = new Rep(RepTest::FNAME);
        $rep->buf = array(array(1,1,1), array(2,2,2), array(3,3,3));
        $rep->updateRow(1, array(4,4,4));
        $this->assertEquals($rep->buf[1], array(4,4,4));
    }

    public function testGetRow(){
        $rep = new Rep(RepTest::FNAME);
        $rep->buf = array(array(1,1,1), array(2,2,2), array(3,3,3));
        $this->assertEquals($rep->getRow(1), array(2,2,2));
    }

    public function testGetRows(){
        $rep = new Rep(RepTest::FNAME);
        $rep->buf = array(array(1,1,1), array(2,2,2), array(3,3,3));
        $this->assertEquals($rep->getRows(1), array(array(1,1,1), array(2,2,2), array(3,3,3)));
    }

    public function testDeleteRow(){
        $rep = new Rep(RepTest::FNAME);
        $rep->buf = array(array(1,1,1), array(2,2,2), array(3,3,3));
        $rep->deleteRow(1);
        $this->assertEquals($rep->buf, array(array(1,1,1), array(3,3,3)));
    }

    public function testCountRows(){
        $rep = new Rep(RepTest::FNAME);
        $rep->buf = array(array(1,1,1), array(2,2,2), array(3,3,3));
        var_dump($rep->countRows());
        $this->assertEquals($rep->countRows(), 3);
    }


}