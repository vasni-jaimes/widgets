<?php

namespace Helpers;
use DateTime;

class HelperWidgets
{
    public static function getAgePlayer( $birthday )
    {
        $dateBirthday = new DateTime($birthday);
        $today        = new DateTime(date("Y-m-d"));
        $age          = $today->diff($dateBirthday);

        return $age->format("%y");
    }

    public static function removeSpaces( $contryName )
    {
        return str_replace(" ", "", $contryName);
    }

    public static function burbuja( $player )
    {
        $n = count($player);
        for ($i = 1; $i <= $n - 1; $i++) {
            for ($j = 1; $j <= $n - $i; $j++) {
                $item = $player[$j - 1];
                $nextItem = $player[$j];

                if ($item->total < $nextItem->total) {
                    $player[$j - 1] = $nextItem;
                    $player[$j] = $item;
                }
            }
        }

        return $player;
    }
}