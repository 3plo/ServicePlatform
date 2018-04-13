<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 21.08.2017
 * Time: 0:26
 */

namespace models\models_exceptions\db_exceptions;

use models\models_exceptions\ExceptionCodeEnum;

/**
 * Class IncorrectQueryTypeException
 * @package models\models_exceptions\db_exceptions
 */
class IncorrectQueryTypeException extends DBException
{
    /**
     * DBConnectException constructor.
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct(
        $message = 'Не существующий тип запроса',
        $code = ExceptionCodeEnum::INCORRECT_QUERY_TYPE,
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