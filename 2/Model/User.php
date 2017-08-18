<?php

namespace Model;


require_once __DIR__ . '/../Model/CheckHelper.php';
require_once __DIR__ . '/../Model/DataBaseModel.php';

class User extends DataBaseModel
{
    protected $name;
    protected $password;
    protected $passwordHash;

    public const MIN_PASSWORD_LEN = 6;
    public const MAX_PASSWORD_LEN = 12;
    public const MIN_NAME_LEN = 3;
    public const MAX_NAME_LEN = 10;

    public function getPassword() : string
    {
        return $this->password;
    }

    public function setPassword(string $password) : void
    {
        CheckHelper::rangeLen($password, User::MIN_PASSWORD_LEN, User::MAX_PASSWORD_LEN);
        $this->password = $password;
        $this->passwordHash = password_hash($password, PASSWORD_DEFAULT);
    }


    public function getPasswordHash() :string
    {
        return $this->passwordHash;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setName($name) : void
    {
        CheckHelper::rangeLen($name, User::MIN_NAME_LEN, User::MAX_NAME_LEN);
        $this->name = $name;
    }

}