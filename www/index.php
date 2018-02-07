<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17.08.2017
 * Time: 23:09
 */

require_once __DIR__ . '/../application/Autoloader.php';
$application = new \application\Application(
    new \application\strategies\application_strategies\DefaultApplicationInitStrategy(),
    new \controllers\Router(
        new \controllers\strategies\HTTPPathScannerStrategey(),
        new \controllers\comands\GeneralErrorHandleComand()
    )
);
$application->init();
$application->run(
    $_SERVER['REQUEST_URI'],
    isset($_REQUEST) ? $_REQUEST : array(),
    isset($_SESSION) ? $_SESSION : array()
);