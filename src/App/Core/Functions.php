<?php

namespace App\Core;

class Functions
{

    public static function dd($value)
    {
        echo "<pre>";
        var_dump($value);
        echo "</pre>";
        die();
    }
}
