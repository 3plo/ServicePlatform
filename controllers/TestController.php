<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17.10.2017
 * Time: 0:01
 */

namespace controllers;


class TestController extends MainController
{

    /**
     * @param array $params
     */
    public function handleAction(array $params)
    {
        $this->getRender()->rend('test_template.twig', []);
    }
}