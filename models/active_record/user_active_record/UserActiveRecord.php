<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 25.01.2018
 * Time: 23:04
 */

namespace models\active_record\user_active_record;


use application\Application;
use models\active_record\ActiveRecord;
use models\models_exceptions\db_exceptions\DBException;

final class UserActiveRecord extends ActiveRecord
{
    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var string
     */
    private $email;

    /**
     * @var ?string
     */
    private $info;

    /**
     * @var bool
     */
    private $active;

    /**
     * @var string
     */
    private $updated_at;

    /**
     * @var int
     */
    private $updated_by;

    /**
     * @var array
     */
    protected static $attributes = [
        'id',
        'password',
        'login',
        'firstname',
        'lastname',
        'email',
        'phone',
        'info',
        'active',
        'updated_at',
        'updated_by'
    ];

    /**
     * @var array
     */
    protected static $rules = [
        'id' => ['type' => 'int', 'length' => 10, 'is_null' => 0, 'mutable' => 0, 'unsigned' => 1, 'default' => null],
        'password' => ['type' => 'string', 'length' => 25, 'is_null' => 0, 'mutable' => 1, 'default' => null],
        'login' => ['type' => 'string', 'length' => 25, 'is_null' => 0, 'mutable' => 1, 'default' => null],
        'firstname' => ['type' => 'string', 'length' => 25, 'is_null' => 0, 'mutable' => 1, 'default' => null],
        'lastname' => ['type' => 'string', 'length' => 25, 'is_null' => 0, 'mutable' => 1, 'default' => null],
        'email' => ['type' => 'string', 'length' => 50, 'is_null' => 0, 'mutable' => 1, 'default' => null],
        'phone' => ['type' => 'string', 'length' => 15, 'is_null' => 0, 'mutable' => 1, 'default' => null],
        'info' => ['type' => 'text', 'length' => 65535, 'is_null' => 1, 'mutable' => 1, 'default' => null],
        'active' => ['type' => 'bool', 'length' => 1, 'is_null' => 0, 'mutable' => 1, 'default' => 1],
        'updated_at' => ['type' => 'datetime', 'is_null' => 0, 'mutable' => 0, 'default' => DATETIME],
        'updated_by' => ['type' => 'int', 'length' => 11, 'unsigned' => 1, 'is_null' => 0, 'mutable' => 0],
    ];
}