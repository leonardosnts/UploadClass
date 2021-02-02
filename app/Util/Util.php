<?php 

namespace App\Util;

class Util
{
    public static function formatValue($value)
    {
        return "R$ ".number_format($value, 2, ',', '.');
    }
}