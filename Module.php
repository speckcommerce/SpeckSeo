<?php

namespace SpeckSeo;

use Zend\Mvc\MvcEvent;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__  => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getControllerConfig()
    {
        return array(
            'invokables' => array(
                'seo_redirect' => 'SpeckSeo\Controller\SeoRedirectController',
            ),
        );
    }

    public function getViewHelperConfig()
    {
        return array(
            'invokables' => array(
                'seoUrl' => 'SpeckSeo\Service\Url',
            )
        );
    }

    public function getServiceConfig()
    {
        return array(
            'invokables' => array(
                'seoUrl' => 'SpeckSeo\Service\Url',
            ),
        );
    }

    public function getConfig()
    {
        return array(
            'router' => array(
                'routes' => array(
                    'product' => array(
                        'child_routes' => array(
                            'byid' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/:id[/:cartItemId]',
                                    'constraints' => array(
                                        'id'         => '[0-9]+',
                                        'cartItemId' => '[0-9]+',
                                    ),
                                    'defaults' => array(
                                        'controller' => 'seo_redirect',
                                        'action'     => 'productById',
                                    ),
                                ),
                            ),
                            'seo' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/:slug:-:id',
                                    'constraints' => array(
                                        'slug' => '[A-Za-z0-9-]+',
                                        'id' => '\d+'
                                    ),
                                ),
                            ),
                        ),
                    ),
                    'category' => array(
                        'child_routes' => array(
                            'byid' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/:id[/:cartItemId]',
                                    'constraints' => array(
                                        'id'         => '[0-9]+',
                                        'cartItemId' => '[0-9]+',
                                    ),
                                    'defaults' => array(
                                        'controller' => 'seo_redirect',
                                        'action'     => 'categoryById',
                                    ),
                                ),
                            ),
                            'seo' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/:slug:-:id',
                                    'constraints' => array(
                                        'slug' => '[A-Za-z0-9-]+',
                                        'id' => '\d+'
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        );

    }

    public function onBootstrap($e)
    {
    }
}
