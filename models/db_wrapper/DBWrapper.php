<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18.08.2017
 * Time: 21:38
 */

namespace models\db_wrapper;


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
class StorageWrapper implements StorageWrapperInterface
{
    /**
     * @var StorageWrapper
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
     * @param ConfigInterface|null $config
     * @return StorageWrapper
     * @throws DBConnectException
     */
    public function getInstance(ConfigInterface $config = null)
    {
        if (!isset($this::$instance)) {
            $defaultConfig = new DBConfig();
            $this::$instance = new StorageWrapper(isset($config)?$defaultConfig:$config);
        }
        return $this::$instance;
    }

    /**
     * @param string $query
     * @return array
     * @throws EscapeQueryException
     * @throws ExecuteQueryException
     * @throws IncorrectQueryDataException
     */
    public function execute(string $query)
    {
        $escapeQuery = $this->pdoInstance->quote($query);
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
    private function changeQueryExequte(string $query)
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
    private function notChangeQueryExecute(string $query)
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