<?php

namespace Rep;
use ArrayObject;
use Model;

require_once __DIR__ . '/../Rep/IRep.php';
require_once __DIR__ . '/../Model/User.php';

class UserRep implements IRep
{

    public function __construct()
    {

    }

    public function getById ($id) : \Model\User
    {
        $user = new \Model\User();
        $user->id = 1;
        return $user;
    }

    public function getAll() : ArrayObject
    {

    }

    public function add(\Model\User $obj)
    {

    }

    public function update(\Model\User $obj)
    {

    }

    public function delete(\Model\User $obj)
    {

    }

    public function getUserByNameAndPasswordHash($name, $passwordHash)
    {

    }
}