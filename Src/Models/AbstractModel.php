<?php
namespace Src\Models;

use Slim\Container;
use Psr\Log\LoggerInterface;

/**
 * Abstract class representing a Model.
 */
abstract class AbstractModel {

    /**
     * @var Container
     */
    protected $container;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var int id
     */
    protected $id;

    /**
     * Instantiates an existing object with the supplied parameters.
     *
     * @param array $data Associative array consisting of the required instantiation parameters.
     */
    abstract public function instantiate($data);

    /**
     * Creates or instantiates the object depending on parameter type.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->logger    = $this->container->get('logger');
    }

    /**
     * Gets the id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the data from the xml file
     *
     * @param $file
     *
     * @return array|\SimpleXMLElement
     */
    public function getXmlData($file)
    {
        if (file_exists($file)) {
            return simplexml_load_file($file);
        }

        return [];
    }
}
