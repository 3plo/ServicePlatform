<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 14.11.2017
 * Time: 21:31
 */

namespace controllers\main_page_controllers;


use controllers\MainController;

class MainPageController extends MainController
{
    public function handleAction(array $params)
    {
        $this->getRender()->rend('main_page/main_page_template.twig', []);
    }
}