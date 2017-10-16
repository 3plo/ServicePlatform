<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 09.10.2017
 * Time: 23:16
 */

namespace application\strategies\application_strategies;


use application\registers\DBConfigRegister;
use application\registers\register_enums\ConfigTypeEnum;

class DefaultApplicationInitStrategy implements ApplicationInitStrategyInterface
{
    public function applicationInit()
    {
        DBConfigRegister::init(ConfigTypeEnum::DEFAULT);
    }
}