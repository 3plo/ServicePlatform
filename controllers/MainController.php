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
    protected $title = '';

    /**
     * @var array
     */
    protected $renderData = [];

    /**
     * @var string
     */
    protected $templatePath = 'main_page.twig';

    /**
     *
     */
    protected function setTemplateTitle()
    {
        $this->addToRenderParams('title', $this->title);
    }


    /**
     * @param array $params
     * @return bool
     */
    protected function setParams(array $params) : bool
    {
        $result = true;
        foreach ($params as $title => $value){
            if (!$this->addToRenderParams($title, $value)) {
                $result = false;
            }
        }
        return $result;
    }

    /**
     * @param string $title
     * @param $value
     * @return bool
     */
    final protected function addToRenderParams(string $title, $value) : bool
    {
        $result = false;
        if (!isset($this->renderData[$title])) {
            // TODO check $value type (not Object) and throw Exception
            $this->renderData[$title] = $value;
            $result = true;
        }
        return $result;
    }

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