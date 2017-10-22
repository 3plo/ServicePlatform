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
     * @var string
     */
    protected $templatePath = 'error_templates/base_error.twig';

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
        $this->getRender()->rend($this->getTemplatePath(),[
            'path' => $_SERVER['REDIRECT_URL'],
            'error_data_access' => $this->hasDedugAccess($params['request']),
            'session' => $params['session'],
            'request' => $params['request']
        ]);
    }
}