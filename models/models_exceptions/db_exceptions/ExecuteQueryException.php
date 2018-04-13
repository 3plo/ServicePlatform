<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 24.08.2017
 * Time: 0:37
 */

namespace models\models_exceptions\db_exceptions;


use models\models_exceptions\ExceptionCodeEnum;

/**
 * Class ExecuteQueryException
 * @package models\models_exceptions\db_exceptions
 */
class ExecuteQueryException extends DBException
{
    /**
     * DBConnectException constructor.
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct(
        $message = 'Не возможно выполнить запрос',
        $code = ExceptionCodeEnum::EXECUTE_QUERY_PROBLEM,
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