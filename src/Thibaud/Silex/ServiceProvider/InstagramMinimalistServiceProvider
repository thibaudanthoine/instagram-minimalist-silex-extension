<?php

namespace Thibaud\Silex\ServiceProvider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Guzzle\Service\Client;
use Thibaud\Library\InstagramApiClient;

/**
 * Class InstagramMinimalistServiceProvider
 *
 * @package Thibaud\Silex\ServiceProvider
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
        if (!isset($app['instagram.api.base_url'])) {
            throw new \InvalidArgumentException('Provide an instagram base url');
        }

        // create guzzle clint instance
        $client = new GuzzleClient($app['instagram.api.base_url']);

        // add instagram api client as a shared service
        $app['instagram.api.client'] = $app->share(function() use ($app, $client) {
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