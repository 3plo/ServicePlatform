<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.04.2018
 * Time: 0:25
 */

namespace models\factories\model_factories;


use models\active_record\user_active_record\UserActiveRecord;
use models\UserModel;

class UserModelFactory
{
    public static function createUserModel() : UserModel
    {
        return new UserModel(new UserActiveRecord());
    }
}