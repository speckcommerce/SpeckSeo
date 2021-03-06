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
            'factories' => array(
                'seoUrl' => function ($sm) {
                    $helper = new Service\Url;
                    $helper->setServiceManager($sm->getServiceLocator());
                    $helper->setHelperManager($sm);
                    return $helper;
                },
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'seoUrl' => function ($sm) {
                    $helper = new Service\Url;
                    $helper->setServiceManager($sm);
                    $helper->setHelperManager($sm->get('viewHelperManager'));
                    return $helper;
                },
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
                                    'route' => '/:id',
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
                                    'route' => '/:slug:-:id:.html',
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
                                    'route' => '/:id',
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
                                    'route' => '/:slug:-:id:.html',
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
