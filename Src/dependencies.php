<?php
/** @var \Slim\Container $container */
$container = $app->getContainer();

/**
 * Model factory
 *
 * @param \Slim\Container $container
 *
 * @return Src\Models\ModelFactory
 */
$container['modelFactory'] = function ($container) {
    return new \Src\Models\ModelFactory($container);
};

/**
 * Monolog
 *
 * @param \Slim\Container $container
 *
 * @return \Monolog\Logger
 */
$container['logger'] = function($container) {
    $settings = $container->get('settings');
    $logger = new Monolog\Logger($settings['logger']['name']);
    $level = ($settings['logger']['debug'] === true) ? Monolog\Logger::DEBUG : Monolog\Logger::INFO;
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['logger']['path'], $level));
    $logger->pushProcessor(new \Monolog\Processor\IntrospectionProcessor());

    return $logger;
};

/**
 * Twig
 *
 * @param \Slim\Container $container
 *
 * @return \Slim\Views\Twig
 */
$container['view'] = function ($container) {
    $settings = $container->get('settings');
    $view = new \Slim\Views\Twig($settings['view']['template_path'], $settings['view']['twig']);

    // Add extensions
    $view->addExtension(new Slim\Views\TwigExtension($container->get('router'), $container->get('request')->getUri()));
    $view->addExtension(new Twig_Extension_Debug());
    $view->addExtension(new Twig_Extensions_Extension_Intl);

    return $view;
};