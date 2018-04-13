<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 25.08.2017
 * Time: 1:22
 */

namespace models\models_exceptions\active_record_exceptions;


use models\models_exceptions\ExceptionCodeEnum;

/**
 * Class ActiveRecordException
 * @package models\models_exceptions\active_record_exceptions
 */
class ActiveRecordException extends \Exception
{
    /**
     * DBConnectException constructor.
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct(
        $message = 'Ошибка при работе с ActiveRecord',
        $code = ExceptionCodeEnum::ACTIVE_RECORD_EXCEPTION,
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