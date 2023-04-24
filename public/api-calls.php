<?php
include './vendor/autoload.php';
use Api\TopScores;
use Api\ErrorLog;

header("Content-type: application/json; charset=utf-8");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    ErrorLog::saveError( $_SERVER['REQUEST_METHOD'].': method not accepted' );
    echo json_encode( [ 'message' => 'method not accepted' ] );
    exit;
}

$input      = json_decode( file_get_contents("php://input"), true );
$scopes    = isset( $input['scopes'] ) ? $input['scopes'] : null;
$sessionID = isset( $input['sessionid'] ) ? $input['sessionid'] : null;

if ( !is_string( $scopes ) || !preg_match("/^[[:alpha:]]+:{1}[[:alpha:]]+$/", $scopes) ) {
    ErrorLog::saveError( $scopes.': invalid parameter "scopes"' );
    echo json_encode([ 'message' => 'invalid parameter "scopes"' ]);
    exit;
}

if ( !is_numeric( $sessionID ) ) {
    ErrorLog::saveError( $sessionID.': invalid parameter "sessionid"' );
    echo json_encode([ 'message' => 'invalid parameter "sessionid"' ]);
    exit;
}

$destructScopes = explode(':', $scopes);
$type           = $destructScopes[0];
$method         = $destructScopes[1];
$results        = null;

switch ($type) {
    case 'topscores':
        if ( $method == 'getTopScoresBySession' ) {
            $objTopScores = new TopScores();
            $results      = $objTopScores->getSesionByID( $sessionID );
            if ( gettype($results) == 'String' ) {
                $results = null;
            }
        }

        break;
    
    default:
        break;
}


if ( $results != null ) {
    echo json_encode( [ 'message' => 'ok', 'data' => $results ] );
    exit;
}

ErrorLog::saveError( 'no_data' );
echo json_encode( [ 'message' => 'no data' ] );