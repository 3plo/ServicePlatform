<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12.09.2017
 * Time: 23:14
 */

namespace views\renders;

use configs\ConfigInterface;

class TwigViewRender implements Render
{
    /**
     * @param array $data
     * @return string
     */
    public function rend(array $data)
    {
        // TODO: Implement rend() method.
    }

    /**
     * @param ConfigInterface $config
     */
    public static function init(ConfigInterface $config)
    {
        // TODO: Implement init() method.
    }
}