<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 24.08.2017
 * Time: 0:46
 */

namespace models\models_exceptions\db_exceptions;


use models\models_exceptions\ExceprionCodeEnum;

/**
 * Class EscapeQueryException
 * @package models\models_exceptions\db_exceptions
 */
class EscapeQueryException extends DBException
{
    /**
     * DBConnectException constructor.
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct(
        $message = 'Не верные данные для запроса',
        $code = ExceprionCodeEnum::ESCAPE_QUERY_EXCEPTION,
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