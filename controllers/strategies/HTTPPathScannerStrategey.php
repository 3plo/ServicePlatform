<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12.10.2017
 * Time: 22:56
 */

namespace controllers\strategies;


class HTTPPathScannerStrategey implements PathScannerStrategeyInterface
{
    /**
     * @var string
     */
    private $controllerDirectory;

    /**
     * @var string
     */
    private $controllerName;

    /**
     * @param array $path
     * @return string
     */
    private function parseConrollerDirectory(array $path) : string
    {
        $result = '';
        foreach ($path as $pathPart) {
            if (!next($path)) {
                break;
            }
            $result .= $pathPart . '\\';
        }
        return substr($result, 1, 0);
    }

    /**
     * @param string $path
     * @return array
     */
    private function separatePath(string $path) : array
    {
        return preg_split('/[^a-z0-9-_]+/', $path);
    }

    /**
     * @param array $controllerName
     * @return string
     */
    private function parseControllerName(array $controllerName) : string
    {
        $controllerName = str_replace('-', '', ucwords(end($controllerName), '-'));
        return $controllerName;
    }

    /**
     * @param string $path
     * @return string
     */
    private function escapePath(string $path) : string
    {
        return str_replace('.', '', $path);
    }

    /**
     * @param string $path
     */
    public function parsePath(string $path)
    {
        $path = $this->escapePath($path);
        $controllerPathParts = $this->separatePath($path);
        $this->controllerDirectory = $this->parseConrollerDirectory($controllerPathParts);
        $this->controllerName = $this->parseControllerName($controllerPathParts);
    }

    /**
     * @return string
     */
    public function getControllerName(): string
    {
        return $this->controllerName;
    }

    /**
     * @return string
     */
    public function getControllerDirectory(): string
    {
        return $this->controllerDirectory;
    }
}