<?php

namespace Test;

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../Model/User.php';


class UserTest extends \PHPUnit\Framework\TestCase
{
    protected $user;
    protected function setUp()
    {
        $this->user = new \Model\User();
    }

    protected function tearDown()
    {

    }

    // ------------- Password -------------
    public function testSetPasswordShort()
    {

        $this->expectException(\InvalidArgumentException::class);
        $this->user->setPassword("12345");
    }

    public function testSetPasswordLong()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->user->setPassword("1234567890123");
    }

    public function testSetCorrectPassword()
    {
        $this->user->setPassword("123456");
        $this->assertEquals("123456", $this->user->getPassword());
    }

    public function testSetCorrectPasswordHash()
    {
        $this->user->setPassword("123456");
        $this->assertEquals(password_verify("123456", $this->user->getPasswordHash()), true);
        //$this->assertEquals(password_hash($pwd, PASSWORD_DEFAULT), $this->user->getPasswordHash());
    }

    // ------------- Name -------------

    public function testSetNameShort()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->user->setName("Va");
    }

    public function testSetNameLong()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->user->setName("Vasia Petrenkovish");
    }

    public function testSetName()
    {
        $this->user->setName("Vasia");
        $this->assertEquals("Vasia", $this->user->getName());
    }



}
