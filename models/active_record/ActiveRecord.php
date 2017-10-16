<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.08.2017
 * Time: 23:41
 */

namespace models\active_record;


use models\active_record\query_builder\QueryBuilderInterafce;
use models\active_record\query_builder\QueryTypeEnum;
use models\db_wrapper\StorageWrapperInterface;
use models\models_exceptions\active_record_exceptions\MoreThenOneObjectWithCurrentParamsException;
use models\models_exceptions\db_exceptions\DBException;

/**
 * Class ActiveRecord
 * @package models\active_record
 */
abstract class ActiveRecord
{
    /**
     * @var StorageWrapperInterface
     */
    protected static $storageWrapper;

    /**
     * @var QueryBuilderInterafce
     */
    protected static $queryBuilder;

    /**
     * @var string
     */
    protected static $storagePart;

    /**
     * @param string $tableName
     * @param array $params
     * @param array $where
     * @param int $limit
     * @return array
     */
    final protected static function find(string $tableName, array $params, array $where, integer $limit) : array
    {
        /** @noinspection PhpParamsInspection */
        $query = self::$queryBuilder->createQuery(
            QueryTypeEnum::SQL_SELECT_QUERY,
            $tableName,
            $params,
            $where,
            $limit
        );
        try {
            $result = self::$storageWrapper->execute($query);
        } catch (DBException $exception) {
            die($exception);
        }
        return $result;
    }

    /**
     * @param string $tableName
     * @param array $params
     * @param array $where
     * @return array
     */
    final protected static function findOne(string $tableName, array $params, array $where) : array
    {
        return self::find($tableName, $params, $where, 1);
    }

    /**
     * @param string $tableName
     * @param array $params
     * @param array $where
     * @return array
     */
    final protected static function findAll(string $tableName, array $params, array $where) : array
    {
        return self::find($tableName, $params, $where, 0);
    }

    /**
     * @param int $id
     * @return ActiveRecord
     * @throws MoreThenOneObjectWithCurrentParamsException
     */
    final public static function init(integer $id) : ActiveRecord
    {
        $storageData = self::findAll(self::$storagePart, [], ['id' => $id]);
        if (!empty($storageData)) {
            if (count($storageData) > 1) {
                throw new MoreThenOneObjectWithCurrentParamsException();
            }
            $result = self::create($id, $storageData);
        } else {
            $result = self::create($id);
        }
        return $result;
    }

    /**
     * Save object to storage
     */
    public function save()
    {
        try {
            if (isset($this->id)) {
                $this->update();
            } else {
                $this->insert();
            }
        } catch (DBException $exception) {
            die($exception);
        }
    }

    /**
     * @param int $id
     * @param array $data
     * @return ActiveRecord
     */
    protected static abstract function create(integer $id,array $data = []);

    /**
     * @throws DBException
     */
    protected abstract function update();

    /**
     * @throws DBException
     */
    protected abstract function insert();

}