<?php
/**
 * Created by PhpStorm.
 * User: b.plotka
 * Date: 22.10.2017
 * Time: 19:17
 */

namespace application\registers;

use application\registers\register_enums\ConfigTypeEnum;
use configs\ConfigInterface;
use configs\RenderConfig;

class RenderConfigRegister implements ConfigRegisterInterface
{

    /**
     * @var RenderConfigRegister
     */
    private static $instance;

    /**
     * @var ConfigRegisterInterface
     */
    private $config;

    /**
     * RenderConfigRegister constructor.
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
    private static function getRenderConfig(string $type) : ConfigInterface
    {
        switch ($type) {
            default :
                $result = new RenderConfig();
        }
        return $result;
    }

    /**
     * @param string $type
     */
    public static function init(string $type = ConfigTypeEnum::DEFAULT)
    {
        RenderConfigRegister::$instance = new RenderConfigRegister(RenderConfigRegister::getRenderConfig($type));
    }

    /**
     * @return ConfigRegisterInterface
     */
    public static function getInstance(): ConfigRegisterInterface
    {
        if (!isset(RenderConfigRegister::$instance)) {
            RenderConfigRegister::init();
        }
        return RenderConfigRegister::$instance;
    }

    /**
     * @return ConfigInterface
     */
    public function getConfig() : ConfigInterface
    {
        return $this->config;
    }
}