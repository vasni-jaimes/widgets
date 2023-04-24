<?php
namespace Api;
use Api\ConnectionAPI;
use Api\ErrorLog;
use Helpers\HelperWidgets;

class TopScores
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

    public function getSesionByID( $sessionID )
    {
        try {
            $params = 'api_token='.$this->token;
            $params .= '&include=player.country;player.position;player.trophies';

            $request = $this->conectAPI
                            ->request( 'GET', 
                                       'https://api.sportmonks.com/v3/football/topscorers/seasons/'.$sessionID.'?'.$params );

            $response = json_decode( $request->getBody()->getContents() );
            if ( isset($response->message) ) {
                ErrorLog::saveError( $response->message );
                return $response->message;
            }
            
            return HelperWidgets::burbuja($response->data);
            

        } catch (\Throwable $th) {
            ErrorLog::saveError( $th->getMessage() );
            return 'error';
        }   
    }
}




