<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 25.08.2017
 * Time: 1:34
 */

namespace models\models_exceptions\active_record_exceptions;


use models\models_exceptions\ExceptionCodeEnum;

/**
 * Class MoreThenOneObjectWithCurrentParamsException
 * @package models\models_exceptions\active_record_exceptions
 */
class MoreThenOneObjectWithCurrentParamsException extends ActiveRecordException
{
    /**
     * DBConnectException constructor.
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct(
        $message = 'Не возможно определить единый элемент в хранилище при инициализации объекта',
        $code = ExceptionCodeEnum::MORE_THEN_ONE_OBJECT_WITH_CURRENT_PARAMS_EXCEPTION,
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