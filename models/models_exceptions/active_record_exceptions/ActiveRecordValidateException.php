<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 06.02.2018
 * Time: 0:05
 */

namespace models\models_exceptions\active_record_exceptions;

use models\models_exceptions\ExceptionCodeEnum;

class ActiveRecordValidateException extends ActiveRecordException
{
    /**
     * DBConnectException constructor.
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct(
        $message = 'Ошибка валидации ActiveRecord',
        $code = ExceptionCodeEnum::ACTIVE_RECORD_VALIDATE_EXCEPTION,
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