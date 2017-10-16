<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12.10.2017
 * Time: 23:28
 */

namespace controllers;


use views\renders\Render;

/**
 * Class MainController
 * @package controllers
 */
abstract class MainController
{

    /**
     * @var Render
     */
    private $render;

    /**
     * MainController constructor.
     * @param Render $render
     */
    final public function __construct (Render $render)
    {
        $this->render = $render;
    }

    /**
     * @return Render
     */
    final protected function getRender() : Render
    {
        return $this->render;
    }

    /**
     * @param array $params
     */
    abstract public function handleAction (array $params);
}