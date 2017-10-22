<?php
/**
 * Created by PhpStorm.
 * User: b.plotka
 * Date: 22.10.2017
 * Time: 19:35
 */

namespace application\registers;

use application\registers\register_enums\ConfigTypeEnum;
use configs\ConfigInterface;

interface ConfigRegisterInterface
{
    /**
     * @param string $type
     */
    public static function init(string $type = ConfigTypeEnum::DEFAULT);

    /**
     * @return ConfigRegisterInterface
     */
    public static function getInstance(): ConfigRegisterInterface;

    /**
     * @return ConfigInterface
     */
    public function getConfig(): ConfigInterface;
}