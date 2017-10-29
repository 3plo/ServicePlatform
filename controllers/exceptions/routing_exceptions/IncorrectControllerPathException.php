<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 26.10.2017
 * Time: 23:56
 */

namespace controllers\exceptions\routing_exceptions;


use controllers\exceptions\ExceptionCodeEnum;

class IncorrectControllerPathException extends RoutingException
{
    /**
     * IncorrectControllerPathException constructor.
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct(
        $message = 'Не удается создать контроллер по заданому пути',
        $code = ExceptionCodeEnum::INCORRECT_CONTROLLER_PATH,
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