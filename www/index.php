<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17.08.2017
 * Time: 23:09
 */

require_once __DIR__ . '/../application/Autoloader.php';
$application = new \application\Application(new \configs\DBConfig());
$application->run($_REQUEST, $_SESSION);