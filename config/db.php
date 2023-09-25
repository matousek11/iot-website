<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => env("MIGRATION") == "true" ? 'mysql:host=' . env("DB_HOST_FOR_MIGRATION") . ';dbname=' . env("DB_NAME") : 'mysql:host=' . env("DB_HOST") . ';port=3306;dbname=' . env("DB_NAME"),
    'username' => env("DB_USER"),
    'password' => env("DB_PASSWORD"),
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];