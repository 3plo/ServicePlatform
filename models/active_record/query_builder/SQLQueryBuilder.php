<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.08.2017
 * Time: 23:48
 */

namespace models\active_record\query_builder;


use models\models_exceptions\db_exceptions\IncorrectQueryDataException;
use models\models_exceptions\db_exceptions\IncorrectQueryTypeException;

/**
 * Class SQLQueryBuilder
 * @package models\active_record\query_builder
 */
class SQLQueryBuilder implements QueryBuilderInterafce
{
    /**
     * @param string $queryType
     * @param string $table
     * @param array $params
     * @param array $where
     * @param int $limit
     * @return string
     * @throws IncorrectQueryDataException
     * @throws IncorrectQueryTypeException
     */
    public function createQuery(
        string $queryType,
        string $table,
        array $params,
        array $where = [],
        int $limit = 0) : string
    {
        $result = '';
        if (empty($table)) {
            throw new IncorrectQueryDataException();
        }
        switch ($queryType) {
            case QueryTypeEnum::SQL_SELECT_QUERY :
                $result = $this->makeSelectQuery($table, $params, $where, $limit);
                break;
            case QueryTypeEnum::SQL_UPDATE_QUERY :
                $result = $this->makeUpdateQuery($table, $params, $where);
                break;
            case QueryTypeEnum::SQL_DELETE_QUERY :
                $result = $this->makeDeleteQuery($table, $where);
                break;
            case QueryTypeEnum::SQL_INSERT_QUERY :
                $result = $this->makeInsertQuery($table, $params);
                break;
            default :
                throw new IncorrectQueryTypeException();
        }
        if (!$result) {
            throw new IncorrectQueryDataException();
        }
        return $result;
    }

    /**
     * @param string $table
     * @param array $where
     * @param array $params
     * @param integer $limit
     * @return bool|string
     */
    private function makeSelectQuery(string $table, array $params, array $where, integer $limit)
    {
        $result = 'SELECT';
        if (!empty($params)) {
            foreach ($params as $key) {
                $result .= $key . ', ';
            }
            $result = substr($result, 0, -2);
        } else {
            $result .= ' * ';
        }
        $result .= $table;
        if (!empty($where)) {
            $result .= $this->makeWhereBlock($where);
        } else {
            return false;
        }
        if ($limit > 0) {
            $result .= ' LIMIT ' . $limit;
        }
        $result .= ';';
        return $result;
    }

    /**
     * @param string $table
     * @param array $params
     * @param array $where
     * @return bool|string
     */
    private function makeUpdateQuery(string $table, array $params, array $where)
    {
        $result = 'UPDATE ' . $table . ' SET ';
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $result .= $key . ' = ' . "'$value', ";
            }
            $result = substr($result, 0, -2);
        } else {
            return false;
        }
        if (!empty($where)) {
            $result .= $this->makeWhereBlock($where);
        } else {
            return false;
        }
        $result .= ';';
        return $result;
    }

    /**
     * @param string $table
     * @param array $where
     * @return bool|string
     */
    private function makeDeleteQuery(string $table, array $where)
    {
        $result = 'DELETE FROM ' . $table;
        if (!empty($where)) {
            $result .= $this->makeWhereBlock($where);
        } else {
            return false;
        }
        $result .= ';';
        return $result;
    }

    /**
     * @param string $table
     * @param array $params
     * @return bool|string
     */
    private function makeInsertQuery(string $table, array $params)
    {
        $result = 'INSERT INTO ' . $table . 'VALUES(';
        if (!empty($params)) {
            $valueTitles = '';
            $valueLists = '';
            foreach ($params as $key => $value) {
                $valueTitles = $key . ', ';
                $valueLists = $value . ', ';
            }
            $valueTitles = substr($result, 0, -2) . ') ';
            $valueLists = substr($result, 0, -2);
            $result .= $valueTitles . $valueLists;
        } else {
            return false;
        }
        $result .= ';';
        return $result;
    }

    /**
     * @param array $where
     * @return string
     */
    private function makeWhereBlock(array $where)
    {
        $result = ' WHERE ';
        foreach ($where as $key => $value) {
            $result .= $key . ' = ' . "'$value' AND ";
        }
        $result = substr($result, 0, -5);
        return $result;
    }
}