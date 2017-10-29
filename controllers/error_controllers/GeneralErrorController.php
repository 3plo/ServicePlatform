<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 22.10.2017
 * Time: 23:36
 */

namespace controllers\error_controllers;


use controllers\MainController;

class GeneralErrorController extends MainController
{

    /**
     * @var \Exception
     */
    protected $exception;

    /**
     * @var string
     */
    protected $templatePath = 'error_templates/base_error.twig';

    /**
     * @var string
     */
    protected $title = 'Error';

    /**
     * @param array|null $params
     * @return bool
     */
    protected function hasDedugAccess(array $params = null) : bool
    {
        return isset($params['access']);
    }

    /**
     * @param array $params
     */
    public function handleAction(array $params)
    {
        $this->setTemplateTitle();
        $this->setParams([
            'path' => $_SERVER['REDIRECT_URL'],
            'error_data_access' => $this->hasDedugAccess($params['request']),
            'session' => $params['session'],
            'request' => $params['request'],
            'stackTrace' => $this->exception
        ]);
        $this->getRender()->rend($this->getTemplatePath(), $this->renderData);
    }

    /**
     * @param \Exception $exception
     */
    public function setError(\Exception $exception)
    {
        $this->exception = $exception;
    }

    /**
     * @return \Exception
     */
    public function getError() : \Exception
    {
        return $this->exception;
    }
}