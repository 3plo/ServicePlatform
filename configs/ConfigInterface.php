<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.08.2017
 * Time: 22:50
 */
namespace configs;

/**
 * Interface ConfigInterface
 * @package configs
 */
interface ConfigInterface
{
    /**
     * @return array
     */
    public function getConfig();
}