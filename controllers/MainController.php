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
     * @var string
     */
    protected $templatePath = 'main_page.twig';

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
     * @param string $templatePath
     */
    final public function setTemplatePath(string $templatePath)
    {
        $this->templatePath = $templatePath;
    }

    final public function getTemplatePath()
    {
        return $this->templatePath;
    }
    /**
     * @param array $params
     */
    abstract public function handleAction (array $params);
}