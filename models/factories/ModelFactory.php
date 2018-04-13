<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.04.2018
 * Time: 0:24
 */

namespace models\factories;


use models\factories\model_factories\UserModelFactory;
use models\Model;
use models\models_exceptions\IncorrectModelNameException;

class ModelFactory
{
    /**
     * @param string $type
     * @return Model
     * @throws IncorrectModelNameException
     */
    public static function create(string $type) : Model
    {
        switch ($type) {
            case ModelNameListEnum::USER_MODEL :
                return UserModelFactory::createUserModel();
                break;
            default :
                throw new IncorrectModelNameException();

        }
    }
}