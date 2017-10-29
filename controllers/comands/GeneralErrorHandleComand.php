<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 22.10.2017
 * Time: 23:39
 */

namespace controllers\comands;


use controllers\error_controllers\GeneralErrorController;
use controllers\exceptions\ExceptionCodeEnum;
use views\renders\Render;

class GeneralErrorHandleComand
{
    public function getErrorHandlerController(\Exception $exception, Render $render)
    {
        switch ($exception->getCode()) {
            case (
                in_array(
                    $exception->getCode(),
                    [
                        ExceptionCodeEnum::ROUTING_EXCEPTION_CODE,
                        ExceptionCodeEnum::INCORRECT_CONTROLLER_PATH
                    ]) ?
                    $exception->getCode() :
                    0
                ) :
                $errorController = new GeneralErrorController($render);
                break;
            default:
                $errorController = new GeneralErrorController($render);
        }
        return $errorController;
    }
}