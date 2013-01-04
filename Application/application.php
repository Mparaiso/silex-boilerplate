<?php

use Silex\Application;
use Application\BusinessLogicLayer\PersonManager;
use Application\DataAccessLayer\PersonProvider;

define("ROOT",dirname(__DIR__));

$loader = require_once(ROOT."/vendor/autoload.php");

$loader->add("Application",ROOT);

$app  = new Silex\Application();

/** configuration **/

$app["loader"] = $loader;

$app["debug"]=true;

/** custom services **/
$app["personManager"]=$app->share(function($app){
    return new PersonManager($app["personProvider"]);
});
$app["personProvider"]=$app->share(function($app){
    return new PersonProvider($app["db"]);
});

/** services **/

$app->register(new Silex\Provider\TwigServiceProvider(),array(
    "twig.path"=>ROOT."/views",
    "twig.options"=>array(
        "cache"=>ROOT."/cache",
        ),
    )
);
$app->register(new Silex\Provider\DoctrineServiceProvider(),array());
$app->register(new Silex\Provider\UrlGeneratorServiceProvider(),array());
$app->register(new Silex\Provider\MonologServiceProvider(),array(
    "monolog.logfile"=>ROOT."/log/logs.txt"
    )
);
$app->register(new Silex\Provider\HttpCacheServiceProvider(),array(
    'http_cache.cache_dir' => ROOT.'/cache/',
));
/*
 SetEnv DBNAME multicouche
        SetEnv HOST localhost
        SetEnv USERNAME camus  
        SetEnv PASSWORD defender
        SetEnv DBDRIVER pdo_mysql
*/
$app->register(new Silex\Provider\DoctrineServiceProvider(),array(
   'db.options'=>array(
    'driver'   => getenv("DBDRIVER"),
    'dbname'   => getenv("DBNAME"),
    'host'     => getenv("HOST"),
    'user'     => getenv("USERNAME"),
    'password' => getenv("PASSWORD"),
    ),
   )
);
/** routes **/

$app->match("/{name}","Application\Controller\IndexController::index")
->value("name","default name")
->bind("index_index");

return $app;

