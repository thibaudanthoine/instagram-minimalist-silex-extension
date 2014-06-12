<?php

namespace Thibaud\Twig\Extension;

use Silex\Application;

/**
 * Class InstagramMinimalistExtension
 *
 * @package Thibaud\Twig\Extension
 */
class InstagramMinimalistExtension extends \Twig_Extension
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @param \Silex\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;

        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../resources/views');
        $this->app['twig.loader']->addLoader($loader);
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction(
                'instagram_minimalist_medias',
                array($this, 'generateInstagramMedias'),
                array(
                    'is_safe' => array('html')
                )
            )
        );
    }

    /**
     * Returns the rendered medias template
     * @return string
     */
    public function generateInstagramMedias()
    {
        return $this->app['twig']->render(
            'medias.html.twig',
            array(
                'medias' => $this->app['instagram.api.client']->getMedias()
            )
        );

    }

    /**
     * Returns the name of the extension
     * @return string The extension name
     */
    public function getName()
    {
        return 'instagram_minimalist_twig_extension';
    }
}