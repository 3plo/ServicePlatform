<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12.09.2017
 * Time: 23:14
 */

namespace views\renders;

use application\registers\RenderConfigRegister;
use configs\ConfigInterface;
use configs\RenderConfig;

class TwigViewRender implements Render
{
    /**
     * @var Render
     */
    private static $instance;

    /**
     * @var
     */
    private $twigInstance;

    private function __construct(\Twig_Environment $twig)
    {
        $this->twigInstance = $twig;
    }

    /**
     * @param string $templateName
     * @param array $data
     */
    public function rend(string $templateName, array $data)
    {
        $template = $this->twigInstance->load($templateName);
        echo $template->render($data);
    }

    /**
     * @param ConfigInterface $config
     */
    public static function init(ConfigInterface $config)
    {
        if (!isset(TwigViewRender::$instance)) {
            require_once $config->getConfig()['autoloader_path'];
            #require_once __DIR__ . '/../../vendor/autoload.php';
            $loader = new \Twig_Loader_Filesystem($config->getConfig()['template_dir']);
            $twig = new \Twig_Environment($loader, array(
                'cache' => !empty($config->getConfig()['cache_dir']) ?
                    $config->getConfig()['cache_dir'] :
                    false
            ));
            TwigViewRender::$instance = new TwigViewRender($twig);
        }
    }

    /**
     * @return Render
     */
    public static function getInstance() : Render
    {
        if (!isset(TwigViewRender::$instance)) {
            TwigViewRender::init(RenderConfigRegister::getInstance()->getConfig());
        }
        return TwigViewRender::$instance;
    }
}