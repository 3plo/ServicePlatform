<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 24.08.2017
 * Time: 23:51
 */

namespace models\models_exceptions\db_exceptions;


use models\models_exceptions\ExceptionCodeEnum;

/**
 * Class DBException
 * @package models\models_exceptions\db_exceptions
 */
class DBException extends \Exception
{
    /**
     * DBConnectException constructor.
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct(
        $message = 'Ошибка при работе с базой данных',
        $code = ExceptionCodeEnum::DB_EXCEPTION,
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