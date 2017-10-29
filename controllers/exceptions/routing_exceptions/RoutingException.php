<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 26.10.2017
 * Time: 23:26
 */

namespace controllers\exceptions\routing_exceptions;



use controllers\exceptions\ExceptionCodeEnum;

class RoutingException extends \Exception
{
    /**
     * RoutingException constructor.
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct(
        $message = 'Не возможно обработать запрос',
        $code = ExceptionCodeEnum::ROUTING_EXCEPTION_CODE,
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