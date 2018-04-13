<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.04.2018
 * Time: 0:31
 */

namespace models\models_exceptions;


class IncorrectModelNameException extends \Exception
{
    /**
     * DBConnectException constructor.
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct(
        $message = 'Не обнаружено такого имени модели',
        $code = ExceptionCodeEnum::MODEL_NAME_HAS_NOT_EXIST,
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