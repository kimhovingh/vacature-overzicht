<?php
namespace Src\Controllers;

use Src\Models\ModelFactory;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class AbstractController
 */
abstract class AbstractController
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * @var Twig
     */
    protected $view;

    /**
     * @var ModelFactory
     */
    protected $modelFactory;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * BaseController constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container    = $container;
        $this->view         = $this->container->get('view');
        $this->modelFactory = $this->container->get('modelFactory');
        $this->logger       = $this->container->get('logger');
    }

    /**
     * Output rendered template with a global navigation
     *
     * @param Request $request
     * @param Response $response
     * @param string $template Template pathname relative to templates directory
     * @param mixed[] $data Associative array of template variables
     */
    protected function render(Request $request, Response $response, $template, $data = [])
    {
        $this->view->render($response, $template, $data);
    }
}
