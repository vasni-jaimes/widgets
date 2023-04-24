<?php
namespace Api;
use GuzzleHttp\Client;


class ConnectionAPI
{
    public $token = "mc4oHNX4hsz8ocGOfBxbsU374wQeDisulQTWD8UiZ6zhAjPpyFLAlD6HVDYg";
    
    public function ConnectClient()
    {
        return $client = new Client();
    }

    public function getToken()
    {
        return $this->token;
    }
}



