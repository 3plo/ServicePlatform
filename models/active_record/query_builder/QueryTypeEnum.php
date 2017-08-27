<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.08.2017
 * Time: 23:52
 */

namespace models\active_record\query_builder;

/**
 * Class QueryTypeEnum
 * @package models\active_record\query_builder
 */
class QueryTypeEnum
{
    /**
     * SQL query type
     */
    const SQL_SELECT_QUERY = 'SELECT';
    const SQL_UPDATE_QUERY = 'UPDATE';
    const SQL_DELETE_QUERY = 'DELETE';
    const SQL_INSERT_QUERY = 'INSERT';

}