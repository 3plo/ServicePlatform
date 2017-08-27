<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 23.08.2017
 * Time: 0:14
 */

namespace application;


use configs\ConfigInterface;

/**
 * Class Application
 * @package application
 */
class Application
{
    /**
     * @var ConfigInterface
     */
    private $dbConfig;

    /**
     * Application constructor.
     * @param ConfigInterface $dbConfig
     */
    public function __construct(ConfigInterface $dbConfig)
    {
        $this->dbConfig = $dbConfig;
    }

    /**
     * @param array $request
     * @param array $session
     */
    public function run(array $request, array $session)
    {

    }


}