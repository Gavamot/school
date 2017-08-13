<?php

namespace Rep;

use ArrayObject;

interface IRep
{
    public function getById ($id) : \Model\User;
    public function getAll() : ArrayObject;
    public function add(\Model\User $obj);
    public function update(\Model\User $obj);
    public function delete(\Model\User $obj);
}