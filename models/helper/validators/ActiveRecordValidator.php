<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 21.02.2018
 * Time: 23:14
 */

namespace models\helper\validators;


class ActiveRecordValidator
{
    /**
     * @param array $rule
     * @param string $title
     * @param $value
     * @return bool
     */
    public static function validate(array $rule, string $title, $value) : bool
    {
        $result = false;
        if ($value && $title) {
            $result = true;
            if ($rule[$title]['length'] && !self::checkLength($rule[$title]['length'], $value)){
                $result = false;
            }
            if ($rule[$title]['mutable'] && !self::canBeMutable((bool)$rule[$title]['mutable'])) {
                $result = false;
            }
            if ($rule[$title]['unsigned'] && !self::checkIsUnsigned($rule[$title]['unsigned'], $value)) {
                $result = false;
            }
            if ($rule[$title]['is_null'] && !self::canBeNull((bool)$rule[$title]['is_null'])) {
                $result = false;
            }
        }
        return $result;
    }

    /**
     * @param string $title
     * @param $value
     * @return bool
     */
    protected static function checkType(string $title, $value) : bool
    {
        return $value instanceof $title;
    }

    /**
     * @param int $length
     * @param $value
     * @return bool
     */
    protected static function checkLength(int $length, $value) : bool
    {
        return strlen((string)$value) <= $length;
    }

    /**
     * @param bool $canBeMutable
     * @return bool
     */
    protected static function canBeMutable(bool $canBeMutable) : bool
    {
        return $canBeMutable;
    }

    /**
     * @param bool $canBeNull
     * @return bool
     */
    protected static function canBeNull(bool $canBeNull) : bool
    {
        return $canBeNull;
    }

    /**
     * @param bool $unsigned
     * @param $value
     * @return bool
     */
    protected static function checkIsUnsigned(bool $unsigned, $value) : bool
    {
        $result = false;
        if ($unsigned && is_numeric($value) && $value >= 0) {
            $result = true;
        }
        return $result;
    }

}