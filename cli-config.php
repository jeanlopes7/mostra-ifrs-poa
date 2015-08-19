<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\Common\ClassLoader,
    Doctrine\ORM\Configuration,
    Doctrine\ORM\EntityManager,
    Doctrine\Common\Cache\ArrayCache,
    Doctrine\DBAL\Logging\EchoSQLLogger;

    define('APPPATH', dirname(__FILE__).DIRECTORY_SEPARATOR);
    require_once APPPATH.'libraries/Doctrine/Common/ClassLoader.php';

    $doctrineClassLoader = new ClassLoader('Doctrine',  APPPATH.'libraries');
    $doctrineClassLoader->register();
    $entitiesClassLoader = new ClassLoader('models', rtrim(APPPATH, "/" ));
    $entitiesClassLoader->register();
    $proxiesClassLoader = new ClassLoader('Proxies', APPPATH.'models/proxies');
    $proxiesClassLoader->register();

    // Set up caches
    $config = new Configuration;
    $cache = new ArrayCache;
    $config->setMetadataCacheImpl($cache);
    //$driverImpl = $config->newDefaultAnnotationDriver(array(APPPATH.'models/Entities'));
    //$config->setMetadataDriverImpl($driverImpl);
    $config->setMetadataDriverImpl(
         new Doctrine\ORM\Mapping\Driver\XmlDriver(APPPATH.'models')
    );
    $config->setQueryCacheImpl($cache);

    $config->setQueryCacheImpl($cache);

    // Proxy configuration
    $config->setProxyDir(APPPATH.'/models/proxies');
    $config->setProxyNamespace('Proxies');

    // Set up logger
    $logger = new EchoSQLLogger;
    $config->setSQLLogger($logger);

    $config->setAutoGenerateProxyClasses( TRUE );
   
    
    // Database connection information
    $connectionOptions = array(
        'driver' => 'pdo_mysql',
        'user' =>     'root',
        'password' => 'fp87694fbr',
        'host' =>     'localhost',
        'dbname' =>   'mostratec'
    );

    // Create EntityManager
    $em = EntityManager::create($connectionOptions, $config);

return ConsoleRunner::createHelperSet($em);
