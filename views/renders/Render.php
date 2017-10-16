<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12.09.2017
 * Time: 23:15
 */

namespace views\renders;


use configs\ConfigInterface;

interface Render
{
    /**
     * @param array $data
     * @return string
     */
    public function rend(array $data);

    /**
     * @param ConfigInterface $config
     */
    public static function init(ConfigInterface $config);
}