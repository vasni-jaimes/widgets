<?php

namespace Api;
use DateTime;

class ErrorLog
{
    public static function saveError($message)
    {
        $date         = date("d-m-Y h:i:s");
        $errorMessage = "[{$date}] {$message}";
        error_log($errorMessage, 3, __DIR__ . '/../logs/error_log.log');
    }
}