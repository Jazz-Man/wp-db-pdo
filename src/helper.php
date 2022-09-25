<?php

if (!function_exists('app_db_pdo')) {
    /**
     * @throws \PDOException
     */
    function app_db_pdo(): PDO {
        global $wpdb;

        static $db;

        if (null === $db) {
            $dsn = sprintf('mysql:host=%1$s;dbname=%2$s', $wpdb->dbhost, $wpdb->dbname);

            $pdo_options = [
                \PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_CASE => PDO::CASE_NATURAL,
                \PDO::ATTR_ORACLE_NULLS => PDO::NULL_NATURAL,
                \PDO::ATTR_STRINGIFY_FETCHES => false,
                \PDO::ATTR_EMULATE_PREPARES => false,
                \PDO::ATTR_PERSISTENT => true,
                \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'",
            ];

            $db = new \PDO($dsn, $wpdb->dbuser, $wpdb->dbpassword, $pdo_options);
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }

        return $db;
    }
}
