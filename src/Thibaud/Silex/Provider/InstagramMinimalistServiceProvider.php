<?php

namespace Thibaud\Silex\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Guzzle\Service\Client;
use Thibaud\Library\InstagramApiClient;

/**
 * Class InstagramMinimalistServiceProvider
 *
 * @package Thibaud\Silex\Provider
 */
class InstagramMinimalistServiceProvider implements ServiceProviderInterface
{
    /**
     * Register service with Silex
     *
     * @param Application $app An Silex Application instance
     */
    public function register(Application $app)
    {
        // add instagram api client as a shared service
        $app['instagram.api.client'] = $app->share(function() use ($app) {

            if (!isset($app['instagram.api.base_url'])) {
                throw new \InvalidArgumentException('Provide an instagram base url');
            }

            // create guzzle clint instance
            $client = new Client($app['instagram.api.base_url']);

            return new InstagramApiClient($app, $client);
        });
    }

    /**
     * Bootstrap application
     *
     * @param Application $app An Silex Application instance
     */
    public function boot(Application $app)
    {
    }
}