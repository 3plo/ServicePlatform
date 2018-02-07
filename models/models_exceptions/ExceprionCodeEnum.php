<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18.08.2017
 * Time: 22:03
 */

namespace models\models_exceptions;

/**
 * Class ExceprionCodeEnum
 * @package models\models_exceptions
 */
class ExceprionCodeEnum extends \Exception
{
    const DB_EXCEPTION = 100000;
    const PDO_CONNECTION_EXCEPTION = 100001;
    const INCORRECT_QUERY_TYPE = 100002;
    const INCORRECT_QUERY_DATA = 100003;
    const EXECUTE_QUERY_PROBLEM = 100004;
    const ESCAPE_QUERY_EXCEPTION = 100005;

    const ACTIVE_RECORD_EXCEPTION = 101000;
    const MORE_THEN_ONE_OBJECT_WITH_CURRENT_PARAMS_EXCEPTION = 101001;
    const CALL_TO_UNDEFINED_PROPERTY_EXCEPTION = 101002;
    const ACTIVE_RECORD_VALIDATE_EXCEPTION = 101003;
    const ACTIVE_RECORD_CLASS_NOT_FOUND_EXCEPTION = 101004;
}