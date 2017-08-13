<?php

require __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../Model/Ref.php';
require_once __DIR__ . '/TestHelper.php';

use Model\Ref;

class RefTest extends \PHPUnit\Framework\TestCase
{
    protected $ref;
    protected function setUp()
    {
        $this->ref = new Ref();
    }

    public function testSetUrlUnCorrect()
    {
        //$this->expectException(InvalidArgumentException::class);
        $this->ref->setUrl("");

    }


}
