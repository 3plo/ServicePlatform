<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 24.08.2017
 * Time: 23:51
 */
namespace models\db_wrapper;

use configs\ConfigInterface;
use models\models_exceptions\db_exceptions\DBConnectException;
use models\models_exceptions\db_exceptions\EscapeQueryException;
use models\models_exceptions\db_exceptions\ExecuteQueryException;
use models\models_exceptions\db_exceptions\IncorrectQueryDataException;


/**
 * Class DBWrapper
 * @package models\db_wrapper
 */
interface StorageWrapperInterface
{
    /**
     * @return StorageWrapperInterface
     * @throws DBConnectException
     */
    public static function getInstance();

    /**
     * @param ConfigInterface $config
     * @throws DBConnectException
     */
    public static function init(ConfigInterface $config);

    /**
     * @param string $query
     * @return array
     * @throws EscapeQueryException
     * @throws ExecuteQueryException
     * @throws IncorrectQueryDataException
     */
    public function execute(string $query);
}