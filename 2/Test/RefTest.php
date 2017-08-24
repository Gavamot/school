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
        $this->expectException( \Exception::class );
        $this->ref->setUrl("");
    }

    public function testGenerateShortUrlCorrect()
    {
        $url = "http://php.net/manual/ru/function.mb-internal-encoding.php";
        $this->ref->setUrl($url);
        $this->assertEquals(md5($url), $this->ref->getShortUrl());
    }
}
