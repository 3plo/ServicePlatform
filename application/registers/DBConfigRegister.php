<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 09.10.2017
 * Time: 21:52
 */

namespace application\registers;


use application\registers\register_enums\ConfigTypeEnum;
use configs\ConfigInterface;
use configs\DBConfig;

class DBConfigRegister
{
    /**
     * @var DBConfigRegister
     */
    private static $instance;

    /**
     * @var ConfigInterface
     */
    private $config;

    /**
     * DBConfigRegister constructor.
     * @param ConfigInterface $config
     */
    private function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }

    /**
     * @param string $type
     * @return ConfigInterface
     */
    private static function getDBConfig(string $type) : ConfigInterface
    {
        switch ($type) {
            default :
                $result = new DBConfig();
        }
        return $result;
    }

    /**
     * @param string $type
     */
    public static function init(string $type = ConfigTypeEnum::DEFAULT)
    {
        if (!isset(DBConfigRegister::$instance)) {
            DBConfigRegister::$instance = new DBConfigRegister(DBConfigRegister::getDBConfig($type));
        }
    }

    /**
     * @return DBConfigRegister
     */
    public static function getInstance() : DBConfigRegister
    {
        if (!isset(DBConfigRegister::$instance)){
            DBConfigRegister::init();
        }
        return DBConfigRegister::$instance;
    }

    /**
     * @return ConfigInterface
     */
    public function getConfig() : ConfigInterface
    {
        return $this->config;
    }
}