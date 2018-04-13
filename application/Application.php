<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 23.08.2017
 * Time: 0:14
 */

namespace application;


use application\strategies\application_strategies\ApplicationInitStrategyInterface;
use configs\ConfigInterface;
use controllers\Router;

/**
 * Class Application
 * @package application
 */
class Application
{
    /**
     * @var ApplicationInitStrategyInterface
     */
    private $applicationInitStrategy;

    /**
     * @var Router
     */
    private $router;

    /**
     * Application constructor.
     * @param ApplicationInitStrategyInterface $applicationInitStrategy
     * @param Router $router
     */
    public function __construct(
        ApplicationInitStrategyInterface $applicationInitStrategy,
        Router $router
    )
    {
        $this->applicationInitStrategy = $applicationInitStrategy;
        $this->router = $router;
    }

    /**
     * init global constants
     */
    public static function init()
    {
        define('DATETIME', date('Y-m-d H:i:s'));
        define('DATE', date('Y-m-d'));
        define('TIME', date('H:i:s'));
        define('TIMESTAMP', time());
    }

    /**
     * @param string $path
     * @param array $request
     * @param array $session
     */
    public function run(string $path, array $request, array $session)
    {
        $this->applicationInitStrategy->applicationInit();
        $this->router->routRequest($path, $request, $session);
    }


}