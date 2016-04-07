<?php

namespace Config;

/**
 * @author Rudys Natanael Acosta Crousset <natanael926@gmail.com>
 *
 * @version 0.1
 */
class Config
{
    /**
     * @var Config
     */
    private static $instance = null;

    /**
     * List of all parameter settings.
     *
     * @var Config
     */
    private $rows = [];

    /**
     * @return Config
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return void
     */
    private function readIniFile()
    {
        $this->rows = parse_ini_file('config.ini', true);
    }

    /**
     * @param  $name
     *
     * @return string
     */
    public function get($name)
    {
        $this->readIniFile();

        return trim($this->rows[$name]);
    }
}
