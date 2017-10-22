<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12.09.2017
 * Time: 23:43
 */

namespace configs;


class RenderConfig implements ConfigInterface
{

    const TEMPLATE_DIR = __DIR__ . '/../views/templates';
    const AUTOLOADER_PATH = __DIR__ . '/../vendor/autoload.php';
    const CACHE_DIR = '';

    final public function getConfig() : array
    {
        return array(
            'template_dir' => RenderConfig::TEMPLATE_DIR,
            'autoloader_path' => RenderConfig::AUTOLOADER_PATH,
            'cache_dir' => RenderConfig::CACHE_DIR
        );
    }
}