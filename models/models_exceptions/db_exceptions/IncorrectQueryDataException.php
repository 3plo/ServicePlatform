<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 21.08.2017
 * Time: 0:32
 */

namespace models\models_exceptions\db_exceptions;

use models\models_exceptions\ExceprionCodeEnum;

/**
 * Class IncorrectQueryDataException
 * @package models\models_exceptions\db_exceptions
 */
class IncorrectQueryDataException extends DBException
{
    /**
     * DBConnectException constructor.
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct(
        $message = 'Не верные данные для запроса',
        $code = ExceprionCodeEnum::INCORRECT_QUERY_DATA,
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