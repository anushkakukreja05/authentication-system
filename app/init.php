<?php
$app = __DIR__; //POINTS TO CURRENT DIRECTORY
require_once("{$app}/../vendor/autoload.php");

require_once("{$app}/helper/functions.inc.php");

require_once("{$app}/classes/AppConfig.class.php");
require_once("{$app}/classes/DatabaseConnection.class.php");
require_once("{$app}/classes/QueryBuilder.class.php");
require_once("{$app}/classes/User.class.php");

$config = AppConfig::getInstance();
$connection = new DatabaseConnection($config);  //injecting dependency

User::migrate($connection, $config->APP_DEBUG);