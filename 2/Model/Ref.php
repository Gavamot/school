<?php

namespace Model;

use Rep\UserRep;

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../Model/DataBaseModel.php';
require_once __DIR__ . '/../Rep/UserRep.php';
require_once __DIR__ . '/../Model/User.php';
require_once __DIR__ . '/../../vendor/wa72/url/src/Wa72/Url/Url.php';

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

    protected function generateShortUrl($url) : string
    {
        $id = $this->getUser()->id;
        $text = md5($url);
        return  $id . $text;
    }

    public function getUrl() : string
    {
        return $this->url;
    }

    public function setUrl($url) : void
    {


        if(!\Wa72\Url\Url::parse($url)->is_url())
            throw new InvalidArgumentException("Is not valid url");
        $this->url = $url;
        $this->shortUrl = $this->generateShortUrl($url);
    }

    public function getShortUrl() : string
    {
        return $this->shortUrl;
    }
}