<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18.08.2017
 * Time: 21:38
 */

namespace models\db_wrapper;


use application\registers\DBConfigRegister;
use configs\ConfigInterface;
use configs\DBConfig;
use models\active_record\query_builder\QueryTypeEnum;
use models\models_exceptions\db_exceptions\DBConnectException;
use models\models_exceptions\db_exceptions\EscapeQueryException;
use models\models_exceptions\db_exceptions\ExecuteQueryException;
use models\models_exceptions\db_exceptions\IncorrectQueryDataException;

/**
 * @property \PDO pdoInstance
 */

/**
 * Class DBWrapper
 * @package models\db_wrapper
 */
class DBWrapper implements StorageWrapperInterface
{
    /**
     * @var StorageWrapperInterface
     */
    private static $instance;

    /**
     * @var \PDO
     */
    private static $pdoInstance;

    /**
     * DBWrapper constructor.
     * @param ConfigInterface $config
     * @throws DBConnectException
     */
    private function __construct(ConfigInterface $config)
    {

        try {
            $dbh = $config['driver'] .
                ':dbname=' . $config['name'] .
                ';host=' . $config['host'] .
                ';port=' . $config['port'];
            $this->pdoInstance = new \PDO($dbh, $config['user'], $config['password']);
        } catch(\PDOException $pdoException) {
            throw new DBConnectException();
        }
    }

    /**
     * @param ConfigInterface $config
     * @throws DBConnectException
     */
    public static function init(ConfigInterface $config)
    {
        if(!isset(DBWrapper::$instance)) {
            DBWrapper::$instance = new DBWrapper($config);
        }
    }

    /**
     * @return StorageWrapperInterface
     * @throws DBConnectException
     */
    public static function getInstance() : StorageWrapperInterface
    {
        if (!isset(DBWrapper::$instance)) {
            $configRegister = DBConfigRegister::getInstance();
            DBWrapper::init($configRegister->getConfig());
        }
        return self::$instance;
    }

    /**
     * @param string $query
     * @return array
     * @throws EscapeQueryException
     * @throws ExecuteQueryException
     * @throws IncorrectQueryDataException
     */
    public function execute(string $query) : array
    {
        $escapeQuery = DBWrapper::$pdoInstance->quote($query);
        if ($escapeQuery === false) {
            throw new EscapeQueryException();
        }
        if (strstr($escapeQuery, 0, 5) == QueryTypeEnum::SQL_SELECT_QUERY) {
            try {
                $result = $this->notChangeQueryExecute($escapeQuery);
            } catch (ExecuteQueryException $exception) {
                throw $exception;
            }
        } elseif(
            in_array(
                strstr($escapeQuery, 0, 5),
                [QueryTypeEnum::SQL_DELETE_QUERY,
                QueryTypeEnum::SQL_INSERT_QUERY,
                QueryTypeEnum::SQL_UPDATE_QUERY]
            )
        ) {
            try {
                $result = $this->changeQueryExequte($escapeQuery);
            } catch (IncorrectQueryDataException $exception) {
                throw $exception;
            }
        } else {
            throw new IncorrectQueryDataException();
        }
        return $result;
    }

    /**
     * @param string $query
     * @return array
     * @throws IncorrectQueryDataException
     */
    private function changeQueryExequte(string $query) : array
    {
        $count = $this->pdoInstance->exec($query);
        if ($count === false) {
            throw new IncorrectQueryDataException();
        }
        $result = ['count_changes' => $count];
        return $result;
    }

    /**
     * @param string $query
     * @return array
     * @throws ExecuteQueryException
     */
    private function notChangeQueryExecute(string $query) : array
    {
        try {
            $pdoStatmentResult = $this->pdoInstance->query($query);
        } catch (\PDOException $exception) {
            throw new ExecuteQueryException();
        }
        $result = [];
        $index = 0;
        foreach ($pdoStatmentResult as $row) {
            $result[$index] = [];
            foreach ($row as $key => $value) {
                $result[$index][$key] = $value;
            }
            ++$index;
        }
        return $result;
    }
}