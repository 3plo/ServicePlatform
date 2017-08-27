<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 22.08.2017
 * Time: 22:29
 */
namespace models\active_record\query_builder;

use models\models_exceptions\db_exceptions\IncorrectQueryDataException;
use models\models_exceptions\db_exceptions\IncorrectQueryTypeException;


/**
 * Class SQLQueryBuilder
 * @package models\active_record\query_builder
 */
interface QueryBuilderInterafce
{
    /**
     * @param QueryTypeEnum $queryType
     * @param string $table
     * @param array $params
     * @param array $where
     * @param integer $limit
     * @return string
     * @throws IncorrectQueryDataException
     * @throws IncorrectQueryTypeException
     */
    public function createQuery(QueryTypeEnum $queryType, string $table, array $params, array $where, integer $limit);
}