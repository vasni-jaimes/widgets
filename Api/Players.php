<?php
namespace Api;
use Api\ConnectionAPI;
use Api\ErrorLog;
use Helpers\HelperWidgets;

class Players
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

    public function getAllPlayers()
    {
        try {
            $params = 'api_token='.$this->token;
            $params .= '&include=country;position;trophies';

            $request = $this->conectAPI
                            ->request( 'GET', 'https://api.sportmonks.com/v3/football/players?'.$params );

            $response = json_decode( $request->getBody()->getContents() );
            return $response->data;

        } catch (\Throwable $th) {
            ErrorLog::saveError( $th->getMessage() );
            return 'error';
        }   
    }

    public function getCountrieForPlayer( $players )
    {
        try {
            $countries = Array();
            foreach ( $players as $player ) {
                if ( !array_search( $player->country->name, $countries ) ) {
                    $countries[] = $player->country->name;
                }
            }

            return $countries;

        } catch (\Throwable $th) {
            ErrorLog::saveError( $th->getMessage() );
            return 'error';
        }   
    }
}




