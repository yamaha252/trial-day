<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

/**
 * Doctrine helper class to work with the current connection
 */
class Connection
{
    const MODELS_PATHS = [__DIR__ . '/Model'];

    /**
     * @var EntityManager
     */
    private static $entityManager;

    /**
     * @return EntityManager
     * @throws \Doctrine\ORM\ORMException
     * @throws UndefinedConfigParam
     */
    public static function getEntityManager(): EntityManager
    {
        if (static::$entityManager === null) {
            $connectionParams = Config::get('connection');
            $config = Setup::createAnnotationMetadataConfiguration(static::MODELS_PATHS, Config::get('debug'));
            return static::$entityManager = EntityManager::create($connectionParams, $config);
        }

        return static::$entityManager;
    }
}
