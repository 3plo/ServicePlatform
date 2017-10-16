<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12.10.2017
 * Time: 22:58
 */
namespace controllers\strategies;

interface PathScannerStrategeyInterface
{
    /**
     * @param string $psth
     */
    public function parsePath(string $path);

    /**
     * @return string
     */
    public function getControllerDirectory() : string;

    /**
     * @return string
     */
    public function getControllerName() : string;
}