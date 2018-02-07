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
use models\models_exceptions\active_record_exceptions\ActiveRecordClassNotFoundExceprion;
use models\models_exceptions\active_record_exceptions\ActiveRecordValidateException;
use models\models_exceptions\active_record_exceptions\CallToUndefinedPropertyException;
use models\models_exceptions\active_record_exceptions\MoreThenOneObjectWithCurrentParamsException;
use models\models_exceptions\db_exceptions\DBException;

/**
 * Class ActiveRecord
 * @package models\active_record
 */
abstract class ActiveRecord
{
    /**
     * @var int
     */
    public $id;

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
     * @return string
     */
    public function getTable() : string
    {
        return $this->table;
    }

    /**
     * @param $value
     * @param string $title
     * @return bool
     */
    final public function validate($value, string $title) : bool
    {
        //TODO create validator class
        $result = false;
        if ($value && $title) {
            if ($value instanceof $title) {
                if ($this->getRules()[$title]['length'] && strlen((string)$value) <= $this->getRules()[$title]['length']) {
                    if ($this->getRules()[$title]['mutable']) {
                        if ($this->getRules()[$title]['unsigned']) {
                            if ((is_int($value) || is_float($value)) && $value >= 0) {
                                $result = true;
                            }
                        } else {
                            $result = true;
                        }
                    } else {
                        $result = true;
                    }
                    $result = true;
                }
            } else {
                $result = true;
            }
        }
        return $result;
    }

    /**
     * @param string $classPath
     * @param int $id
     * @param array $data
     * @return ActiveRecord|null
     * @throws ActiveRecordClassNotFoundExceprion
     * @throws ActiveRecordValidateException
     * @throws CallToUndefinedPropertyException
     */
    protected static function create(string $classPath, integer $id = 0, array $data = []) : ?ActiveRecord
    {
        /**
         * @var ?ActiveRecord
         */
        $instance = null;
        try {
            $instance = new $classPath();
        } catch (\Exception $exception) {
            throw new ActiveRecordClassNotFoundExceprion();
        }
        foreach ($data as $key => $value) {
            try {
                $instance->$key = $value;
            } catch (CallToUndefinedPropertyException $callToUndefinedPropertyException) {
                throw $callToUndefinedPropertyException;
            } catch (ActiveRecordValidateException $activeRecordValidateException) {
                throw $activeRecordValidateException;
            }
        }
        return $instance;
    }

    /**
     * @param $property
     * @param $value
     * @throws ActiveRecordValidateException
     * @throws CallToUndefinedPropertyException
     */
    protected function __set($property, $value) {
        if (!property_exists($this, $property)) {
            throw new CallToUndefinedPropertyException();
        }
        if (!$this->validate($value, $property)) {
            throw new ActiveRecordValidateException();
        }
        $this->$property = $value;
    }

    /**
     * @param $property
     * @return mixed
     * @throws CallToUndefinedPropertyException
     */
    public function __get($property) {
        if (!property_exists($this, $property)) {
            throw new CallToUndefinedPropertyException();
        }
        return $this->$property;
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
     * @return array
     */
    public function getAttributes() : array
    {
        return $this->attributes;
    }

    /**
     * @return array
     */
    public function getRules() : array
    {
        return $this->rules;
    }

    /**
     * @throws DBException
     * @param array $params
     * @param array $where
     */
    protected function update(array $params, array $where)
    {
        $query = $this->queryBuilder->createQuery(
            QueryTypeEnum::SQL_UPDATE_QUERY,
            $this->getTable(),
            $params,
            $where
        );
        $this->storageWrapper->execute(
            $query
        );
    }

    /**
     * @throws DBException
     * @param array $params
     * @return array
     */
    protected function insert(array $params) : array
    {
        $query = $this->queryBuilder->createQuery(
            QueryTypeEnum::SQL_UPDATE_QUERY,
            $this->getTable(),
            $params
        );
        $result = $this->storageWrapper->execute(
            $query
        );
        return $result;
    }

}