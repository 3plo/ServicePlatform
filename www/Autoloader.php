<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 17.08.2017
 * Time: 23:20
 */
class Autoloader
{
    public function loadClass($class)
    {
        $rootDir = __DIR__ . '/../';
        $path = $rootDir . $class . '.php';
        if (!class_exists($class))
        {
            if (file_exists($path))
            {
                require($path);
            }
        }
    }
}

spl_autoload_register([new Autoloader(), 'loadClass']);