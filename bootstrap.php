<?php
require_once __DIR__ . "/vendor/autoload.php";

use Silex\Application;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Configuration;
use Doctrine\Common\Cache\ArrayCache as Cache;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Annotations\AnnotationReader;


$config = new Configuration();
$cache = new Cache();
$config->setQueryCacheImpl($cache);
$config->setProxyDir('/tmp');
$config->setProxyNamespace('EntityProxy');
$config->setAutoGenerateProxyClasses(true);

AnnotationRegistry::registerFile(__DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'doctrine' . DIRECTORY_SEPARATOR . 'orm' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'Doctrine' . DIRECTORY_SEPARATOR . 'ORM' . DIRECTORY_SEPARATOR . 'Mapping' . DIRECTORY_SEPARATOR . 'Driver' . DIRECTORY_SEPARATOR . 'DoctrineAnnotations.php');

//$driver = new Doctrine\ORM\Mapping\Driver\AnnotationDriver(
//    new AnnotationReader(),
//    array(__DIR__ . DIRECTORY_SEPARATOR . 'src')
//);
//$config->setMetadataDriverImpl($driver);
//$config->setMetadataCacheImpl($cache);

$params = array(
//    'driverClass' => 'Lsw\DoctrinePdoDblib\Doctrine\DBAL\Driver\PDODblib\Driver',
//    'host' => 'CORUSCANT',
//    'port' => '1433',
//    'user' => 'user_api',
//    'password' => 'pwdapi2015',
//    'dbname' => 'Db_Geral',
//    'charset' => 'utf8'
);

//Doctrine\DBAL\Types\Type::overrideType("datetime", "Doctrine\\DBAL\\Types\\VarDateTimeType");
date_default_timezone_set('America/Fortaleza');

$app = new Application();

$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . "/src/naCidade/View",
    'debug'=> true,
));
$app['twig']->addExtension(new Twig_Extension_Debug());
//$app['em'] = EntityManager::create(
//    $params,
//    $config
//);