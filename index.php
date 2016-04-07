<?php

define('__ROOT__', dirname(dirname(__FILE__)));
error_reporting(E_ALL);

require 'vendor/autoload.php';

use Config\Config;
use Db\Db;
use Db\DBAbstration;

$conn = DBAbstration::getInstance();
// $p = $conn->select("select * from user");

$p = new Db();
$p->create();

// use Core\Config\Config;

// var_dump(Config::getInstance()->get('host'));
