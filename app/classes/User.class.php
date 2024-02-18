<?php
class User {
    private static string $table = 'users';

    public static  function migrate(DatabaseConnection $connection, bool $debug) {
        $queryBuilder = new QueryBuilder($connection, $debug);
        $table = self::$table;
        $ddl = <<<DDL
            CREATE TABLE IF NOT EXISTS {$table} (
                id INT(11) PRIMARY KEY AUTO_INCREMENT,
                username VARCHAR(255),
                email VARCHAR(255),
                password VARCHAR(255)
            );
            DDL;

            $queryBuilder->executeDDL($ddl);
    }
}