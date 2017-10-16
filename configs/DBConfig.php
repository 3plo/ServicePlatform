<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18.08.2017
 * Time: 21:38
 */

namespace configs;

/**
 * Class DBConfig
 * @package configs
 */
class DBConfig implements ConfigInterface
{
    const DRIVER = 'mysql';
    const HOST = '127.0.0.1';
    const NAME = 'services_platform_db';
    const USER = 'root';
    const PASSWORD = '';
    const PORT = '3306';

    /**
     * @return array
     */
    final public function getConfig() : array
    {
        return array(
            'driver' => DBConfig::DRIVER,
            'host' => DBConfig::HOST,
            'name' => DBConfig::NAME,
            'user' => DBConfig::USER,
            'password' => DBConfig::PASSWORD,
            'port' => DBConfig::PORT
        );
    }
}