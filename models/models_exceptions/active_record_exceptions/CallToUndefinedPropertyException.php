<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 05.02.2018
 * Time: 1:02
 */

namespace models\models_exceptions\active_record_exceptions;

use models\models_exceptions\ExceptionCodeEnum;

class CallToUndefinedPropertyException extends ActiveRecordException
{
    /**
     * DBConnectException constructor.
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct(
        $message = 'Обращение к несуществующему полю',
        $code = ExceptionCodeEnum::CALL_TO_UNDEFINED_PROPERTY_EXCEPTION,
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