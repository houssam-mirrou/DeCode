<?php

namespace App\Core;

use eftec\bladeone\BladeOne;

class View
{
    private $blade;
    private static $instance;
    private function __construct()
    {
        $views = __DIR__ . '/../../Views';
        $cache = __DIR__ . '/../../cache';
        $this->blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);
    }

    public static function get_instance(){
        if(self::$instance == null){
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function view() {}
}
