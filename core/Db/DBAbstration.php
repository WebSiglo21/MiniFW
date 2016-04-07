<?php

namespace Db;

use Config\Config;
use Utiliti\MyArray as MyArray;

/**
 * @author Natanael Acosta Crousset <natanael926@gmail.com>
 */
class DBAbstration
{
    /**
     * @var DBAstration
     */
    private static $instance = null;

    private $conn = null;

    private $sql;

    private $argsDataExecute = [];

    /**
     * @return DBAstration
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function __construct()
    {
        try {
            $nameDB = Config::getInstance()->get('name');
            $hostDB = Config::getInstance()->get('host');
            $user = Config::getInstance()->get('user');
            $pass = Config::getInstance()->get('pass');
            $argument = sprintf('mysql:dbname=%s;host=%s;', $nameDB, $hostDB);
            $this->conn = new \PDO($argument, $user, $pass);
        } catch (PDOException $e) {
            echo '¡Error!: '.$e->getMessage().'<br/>';
            die();
        }
    }

    public function create()
    {
        try {
            $this->preparingSql('insert');
            $this->query();
        } catch (PDOException $Exception) {
            echo $Exception->getMessage();
            // throw new MyDatabaseException( $Exception->getMessage( ) , $Exception->getCode( ) );
        }
    }

    /**
     * @param string $action {select, insert, update, delete}
     */
    protected function preparingSql($action = 'insert')
    {
        $nameCulumn = [];
        $nameCulumnPdo = [];
        $this->argsDataExecute = new MyArray();

        foreach ($this->args as $value) {
            $this->argsDataExecute->addElement($value['keyPdo'], $value['value']);
            $nameCulumn[] = $value['key'];
            $nameCulumnPdo[] = $value['keyPdo'];
        }

        if ($action == 'insert') {
            $this->sql = 'INSERT INTO '.$this->name;
            $this->sql .= '('.implode($nameCulumn, ',').')';
            $this->sql .= 'VALUES';
            $this->sql .= '('.implode($nameCulumnPdo, ',').')';
        }

        return true;
    }

    /**
     * @param $query String
     * @param $tableName String
     * @param $args Array
     */
    public function query($sql = null, $args = null)
    {
        if ($sql == null) {
            $sql = $this->sql;
        }

        if ($args == null) {
            $args = $this->argsDataExecute;
        }

        $reponce = $this->conn->prepare($sql);
        $reponce->execute($args->get());
    }
}
