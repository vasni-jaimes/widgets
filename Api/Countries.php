<?php

namespace Api;
use Api\ConnectionAPI;
use Api\ErrorLog;
use Helpers\HelperWidgets;

class Countries
{
    protected $conectAPI;
    protected $token;
    protected $include;

    public function __construct()
    {
        $conn            = new ConnectionAPI();
        $this->conectAPI = $conn->ConnectClient();
        $this->token     = $conn->getToken();
    }


    public function getAllCountries()
    {
        try {

            $params = 'api_token='.$this->token;
            $params .= '&select=name,id';
            
            $request = $this->conectAPI
                            ->request( 'GET', 'https://api.sportmonks.com/v3/core/countries?'.$params );

            $response = json_decode( $request->getBody()->getContents() );
            return $response->data;

        } catch (\Throwable $th) {
            ErrorLog::saveError( $th->getMessage() );
            return 'error';
        }
        
    }


    
}