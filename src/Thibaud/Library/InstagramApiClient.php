<?php

namespace Thibaud\Library;

use Silex\Application;
use Guzzle\Service\Client;

/**
 * Class InstagramApiClient
 *
 * @package Thibaud\Library
 */
class InstagramApiClient
{
    /**
     * @var Application
     */
    protected $_app;

    /**
     * @var Client
     */
    protected $_client;

    public function __construct(Application $app, Client $client)
    {
        $this->_app = $app;
        $this->_client = $client;

        if (!isset($app['instagram.user_id'])) {
            throw new \InvalidArgumentException('Provide an user id');
        }

        if (!isset($app['instagram.access_token'])) {
            throw new \InvalidArgumentException('Provide an access token');
        }
    }

    public function getMedias()
    {
        $url = sprintf(
            '/v1/users/%s/media/recent/?access_token=%s',
            $this->_app['instagram.user_id'],
            $this->_app['instagram.access_token']
        );

        $response = $this->_client->get($url)->send();

        return json_decode($response->getBody(true));
    }
}

