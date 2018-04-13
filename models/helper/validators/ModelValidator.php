<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.04.2018
 * Time: 0:12
 */

namespace models\helper\validators;


abstract class ModelValidator
{
    /**
     * @param $item
     * @param array $pattern
     * @return bool
     */
    public static function validate($item, array $pattern) : boolean
    {
        $result = true;
        foreach ($pattern as $rule) {
            if (!self::check($item, $rule)) {
                $result = false;
                break;
            }
        }
        return $result;
    }

    /**
     * @param $item
     * @param $rule
     * @return bool
     */
    protected abstract function check($item, $rule) : boolean;
}