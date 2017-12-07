<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 09.10.2017
 * Time: 23:33
 */

namespace controllers;


use controllers\comands\GeneralErrorHandleComand;
use controllers\error_controllers\GeneralErrorController;
use controllers\exceptions\ExceptionCodeEnum;
use controllers\exceptions\routing_exceptions\IncorrectControllerPathException;
use controllers\exceptions\routing_exceptions\RoutingException;
use controllers\strategies\PathScannerStrategeyInterface;
use views\renders\Render;
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
     * @var GeneralErrorHandleComand
     */
    private $errorHandlerComand;

    /**
     * @param RoutingException $exception
     * @param Render $render
     * @return GeneralErrorController
     */
    private function handleError(RoutingException $exception, Render $render) : GeneralErrorController
    {
        $controller = $this->errorHandlerComand->getErrorHandlerController($exception, $render);
        return $controller;
    }

    /**
     * @param string $controllerPath
     * @param Render $render
     * @return MainController
     * @throws IncorrectControllerPathException
     */
    private function createControllerItemByPath(string $controllerPath, Render $render) : MainController
    {
        if (class_exists($controllerPath)) {
            $controller = new $controllerPath($render);
        } else {
            throw new IncorrectControllerPathException(
                'Не удается создать контроллер по заданому пути',
                $code = ExceptionCodeEnum::INCORRECT_CONTROLLER_PATH
            );
        }
        return $controller;
    }

    /**
     * @param string $path
     * @return string
     */
    private function createControllerPath(string $path) : string
    {
        $this->pathScannerStrategy->parsePath($path);
        $classPath = Router::CONTROLLER_ROOT_DIR.
            $this->pathScannerStrategy->getControllerDirectory() .
            $this->pathScannerStrategy->getControllerName();
        return $classPath;
    }

    /**
     * Router constructor.
     * @param PathScannerStrategeyInterface $pathScannerStrategy
     * @param GeneralErrorHandleComand $errorHandleComand
     */
    public function __construct(
        PathScannerStrategeyInterface $pathScannerStrategy,
        GeneralErrorHandleComand $errorHandleComand
    )
    {
        $this->pathScannerStrategy = $pathScannerStrategy;
        $this->errorHandlerComand = $errorHandleComand;
    }

    /**
     * @param string $path
     * @param array $request
     * @param array $session
     */
    public function routRequest(string $path, array $request, array $session)
    {
        $classPath = $this->createControllerPath($path);
        try {
            $controller = $this->createControllerItemByPath($classPath, TwigViewRender::getInstance());
        } catch (RoutingException $exception) {
            $controller = $this->handleError($exception, TwigViewRender::getInstance());
            $controller->setError($exception);
        }
        $controller->handleAction(array(
            'request' => $request,
            'session' => $session,
            'path' => $path
        ));
    }
}