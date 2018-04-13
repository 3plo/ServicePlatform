<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18.08.2017
 * Time: 22:03
 */

namespace models\models_exceptions\db_exceptions;


use models\models_exceptions\ExceptionCodeEnum;

/**
 * Class DBConnectException
 * @package models\models_exceptions\db_exceptions
 */
class DBConnectException extends  DBException
{
    /**
     * DBConnectException constructor.
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct(
        $message = 'Не возможно выполнить подключение к базе данных',
        $code = ExceptionCodeEnum::PDO_CONNECTION_EXCEPTION,
        \Exception $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return __CLASS__ . ': [{$this->code}]: {$this->message}';
    }
}