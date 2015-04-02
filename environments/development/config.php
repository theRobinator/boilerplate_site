<?php

// Directories
define('SITE_ROOT', dirname(dirname(__DIR__)));
define('LIBS_DIR',  SITE_ROOT . '/lib');
define('WWW_DIR',   SITE_ROOT . '/www');

// URLs
define('URL_ROOT', '/~robinkeller/games/www');
define('API_URL',    URL_ROOT . '/api/api.php');
define('STATIC_URL', URL_ROOT . '/static');
define('CSS_URL',    STATIC_URL . '/css');
define('JS_URL',     STATIC_URL . '/js');
define('IMAGE_URL',  STATIC_URL . '/images');

// MySQL
define('MYSQL_HOST',        'localhost');
define('MYSQL_USER',        'root');
define('MYSQL_PASSWORD',    '');

// Other settings
define('ENVIRONMENT_NAME',  basename(__DIR__));
define('MINIFY_STATICS',    false);


// Configuration for JS. Don't include any sensitive or unnecessary information here.
global $JS_CONFIG;
$JS_CONFIG = array(
    'URL_ROOT'  =>  URL_ROOT,
    'API_URL'   =>  API_URL,
    'CSS_URL'   =>  CSS_URL,
    'JS_URL'    =>  JS_URL,
    'IMAGE_URL' =>  IMAGE_URL
);
