<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 21.02.2018
 * Time: 22:56
 */

namespace models;

use models\active_record\user_active_record\UserActiveRecord;

class UserModel extends Model
{
    /**
     * UserModel constructor.
     * @param UserActiveRecord $activeRecord
     */
    public function __construct(UserActiveRecord $activeRecord)
    {
        parent::__construct($activeRecord);
    }
}