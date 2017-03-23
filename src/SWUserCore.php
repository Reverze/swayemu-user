<?php

use XA\PlatformClient;


class SWUserCore
{
    /**
     * Generic user
     * @var XA\PlatformClient\Controller\User\XAUserGeneric
     */
    private static $userGeneric = null;

    /**
     * User environment
     * @var XA\PlatformClient\Controller\User\XAUserEnvironment
     */
    private static $userEnvironment = null;

    public function __construct(array $parameters)
    {
        /**
         * Array with parameters cannot be empty
         */
        if (empty($parameters)){
            throw new Exception("Array with parameters is empty!");
        }

        $this->bootstrap($parameters);

    }

    /**
     * Bootstrap platform client
     * @param array $parameters
     * @throws Exception
     */
    private function bootstrap(array $parameters)
    {
        /**
         * Client application's ID
         */
        $clientAppId = null;

        /**
         * Provider's hostname
         */
        $providerHostName = null;

        /**
         * Provider's service port
         */
        $providerServicePort = 3000;

        /**
         * Cache driver type
         */
        $cacheDriverType = 'apcu';

        /**
         * Cache's lifetime multiplier
         */
        $cacheLifetimeMultiplier = 2;

        $cacheDriverOptionalParameters = array();

        /**
         * Provider's parameters are required
         */
        if (!array_key_exists('provider', $parameters)){
            throw new Exception("Parameter 'provider' is not defined in parameters");
        }


        $clientAppId = $parameters['provider']['app_id'] ?? null;
        $providerHostName = $parameters['provider']['provider_host'] ?? null;
        $providerServicePort = $parameters['provider']['provider_port'] ?? null;

        /**
         * If some of cache parameters are not defined, default values will be used
         */
        $cacheDriverType = $parameters['cache']['driver_type'] ?? 'apcu';
        $cacheLifetimeMultiplier = $parameters['cache']['lifetime_multiplier'] ?? 2;
        $cacheDriverOptionalParameters = $parameters['cache']['parameters'] ?? array();

        if (empty($clientAppId)){
            throw new Exception("Application's ID is not defined!");
        }

        if (empty($providerHostName)){
            throw new Exception("Provider's hostname is not defined!");
        }

        if (empty($providerServicePort)){
            throw new Exception("Provider's port is not defined!");
        }

        $platformCredentials = new PlatformClient\Auth\PlatformCredentials();
        $platformCredentials->setAppKey($clientAppId);
        $platformCredentials->setProvider($providerHostName);
        $platformCredentials->setPort($providerServicePort);

        $cacheDriverParameters = new PlatformClient\Cache\CacheDriverParameters();
        $cacheDriverParameters->setDriver($cacheDriverType);
        $cacheDriverParameters->setMultiplier($cacheLifetimeMultiplier);
        $cacheDriverParameters->setParameters($cacheDriverOptionalParameters);

        $core = new PlatformClient\Core();
        $core->setProvider($platformCredentials);
        $core->setCacheParameters($cacheDriverParameters);
        $core->connect();
        
        static::$userEnvironment = new PlatformClient\Controller\User\XAUserEnvironment();
        static::$userGeneric = new PlatformClient\Controller\User\XAUserGeneric();
    }

    /**
     * Gets instance of user environment
     * @return PlatformClient\Controller\User\XAUserEnvironment
     */
    public static function getUserEnvironment()
    {
        return static::$userEnvironment;
    }

    /**
     * Gets instance of generic user
     * @return PlatformClient\Controller\User\XAUserGeneric
     */
    public static function getUserGeneric()
    {
        return self::$userGeneric;
    }

}

?>