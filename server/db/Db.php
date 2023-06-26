<?php

namespace db;

use PDO;
use PDOException;

class Db
{
    protected static PDO $instance;

    protected function __construct()
    {
    }

    public static function getInstance(): PDO
    {
        if (empty(self::$instance)) {
            $db_info = array(
                "db_host" => "db",
                "db_port" => "3306",
                "db_user" => "MYSQL_USER",
                "db_pass" => "MYSQL_PASSWORD",
                "db_name" => "MY_DATABASE",
                "db_charset" => "UTF-8"
            );
            try {
                self::$instance = new PDO("mysql:host=" . $db_info['db_host'] . ';port=' . $db_info['db_port'] . ';dbname=' . $db_info['db_name'], $db_info['db_user'], $db_info['db_pass']);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
                self::$instance->query('SET NAMES utf8');
                self::$instance->query('SET CHARACTER SET utf8');
            } catch (PDOException $error) {
                echo $error->getMessage();
            }
        }
        return self::$instance;
    }
}
