<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17.11.2017
 * Time: 0:58
 */

namespace controllers\comands;


class SourceFilePathParseCommand
{
    /**
     * @var string
     */
    private $sourceFilesDir;

    /**
     * SourceFilePathParseCommand constructor.
     * @param string $sourceFilesDir
     */
    public function __construct(string $sourceFilesDir)
    {
        $this->sourceFilesDir = $sourceFilesDir;
    }

    /**
     * @param string $path
     * @return string
     */
    public function parsePath(string $path) : string
    {
        return $this->sourceFilesDir . $path;
    }
}