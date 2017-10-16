<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 09.10.2017
 * Time: 23:33
 */

namespace controllers;


use controllers\strategies\PathScannerStrategeyInterface;
use views\renders\TwigViewRender;

/**
 * Class Router
 * @package controllers
 */
class Router
{
    const CONTROLLER_ROOT_DIR = 'controllers\\';
    /**
     * @var PathScannerStrategeyInterface
     */
    private $pathScannerStrategy;

    /**
     * Router constructor.
     * @param PathScannerStrategeyInterface $pathScannerStrategy
     */
    public function __construct(PathScannerStrategeyInterface $pathScannerStrategy)
    {
        $this->pathScannerStrategy = $pathScannerStrategy;
    }

    /**
     * @param string $path
     * @param array $request
     * @param array $session
     */
    public function routRequest(string $path, array $request, array $session)
    {
        $this->pathScannerStrategy->parsePath($path);
        $classPath = Router::CONTROLLER_ROOT_DIR.
            $this->pathScannerStrategy->getControllerDirectory() .
            $this->pathScannerStrategy->getControllerName();
        // TODO: handle error classNotExist/fileNotExist
        $controller = new $classPath(new TwigViewRender());
        $controller->handleAction(array(
            'request' => $request,
            'session' => $session
        ));
    }
}