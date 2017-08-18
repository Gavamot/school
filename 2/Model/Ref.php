<?php

namespace Model;

use Rep\UserRep;

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../Model/DataBaseModel.php';
require_once __DIR__ . '/../Rep/UserRep.php';
require_once __DIR__ . '/../Model/User.php';

class Ref extends DataBaseModel
{
    public $userId;
    public $url;
    protected $shortUrl;

    public function getUser() : User
    {
        $userRep = new UserRep();
        return $userRep->getById($this->userId);
    }

    public function generateShortUrl($url) : string
    {
        /*
        $hash = md5($url);
        $res = "";
        for ($i=0; $i< 32 - 1; $i+= 2) {
            $number = $hash[$i] . $hash[$i+1];
            $res .= chr($number);
        }
        */
        return md5($url);
    }



    public function getUrl() : string
    {
        return $this->url;
    }
    public function setUrl($url) : void
    {
        if( !filter_var($url, FILTER_VALIDATE_URL))
            throw new \Exception("Is not valid url");
        $this->url = $url;
        $this->shortUrl = $this->generateShortUrl($url);
    }

    public function getShortUrl() : string
    {
        return $this->shortUrl;
    }
}