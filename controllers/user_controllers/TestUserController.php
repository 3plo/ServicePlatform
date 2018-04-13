<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.04.2018
 * Time: 0:41
 */

namespace controllers\user_controllers;


use controllers\MainController;
use models\factories\ModelFactory;

class TestUserController extends MainController
{

    /**
     * @param array $params
     */
    public function handleAction(array $params)
    {
        die(var_dump(ModelFactory::create('User')));
    }
}