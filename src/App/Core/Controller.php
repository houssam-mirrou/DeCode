<?php

namespace App\Core;

use eftec\bladeone\BladeOne;

class Controller
{
    protected static $blade;

    public static function view(string $view, array $data = [])
    {
        if (self::$blade == null) {
            $views = __DIR__ . '/../../Views';

            $cache = __DIR__ . '/../../cache';

            self::$blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);
        }
        echo self::$blade->run($view, $data);
    }
}
