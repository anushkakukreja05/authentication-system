<?php
class AppConfig {
    private static $instance = null;
    public string $DB_NAME;
    public string $DB_HOST;
    public string $DB_USERNAME;
    public string $DB_PASSWORD;
    public bool $APP_DEBUG = false;

    private function __construct() {

    }

    public static function getInstance(string $rootPath ="./"):self {
        if(self::$instance === null) {
            self::$instance = new self();
        }
        self::reloadEnv($rootPath);
        return self::$instance;
    }

    private static function reloadEnv(string $rootPath): void {
        try {
            $dotEnv = Dotenv\Dotenv::createUnsafeImmutable($rootPath);
            $dotEnv->load();

            $dotEnv->required(['APP_DEBUG']);
            self::$instance->APP_DEBUG = getenv("APP_DEBUG") !== "false";

            $dotEnv->required(['DB_NAME','DB_USERNAME','DB_PASSWORD','DB_HOST']);
            self::$instance->DB_NAME = getenv("DB_NAME");
            self::$instance->DB_HOST = getenv("DB_HOST");
            self::$instance->DB_USERNAME = getenv("DB_USERNAME");
            self::$instance->DB_PASSWORD = getenv("DB_PASSWORD");

        }catch(Exception $e) {
            die(
                self::$instance->APP_DEBUG ?  $e->getMessage() : 'Unable to find config!'
            );
        }
    }
}