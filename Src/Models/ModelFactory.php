<?php
namespace Src\Models;

use \Slim\Container;
use Src\Exceptions\MissingModelException;

class ModelFactory
{
    /**
     * @var \Slim\Container
     */
    protected $container;

    /**
     * ModelFactory constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Build model from the model directory based on type
     *
     * @param string        $type
     * @param array|null    $data
     *
     * @return AbstractModel
     * @throws MissingModelException
     */
    public function build($type, $data = null)
    {
        $modelName = $this->getModelName($type);
        if ($modelName === false) {
            throw new MissingModelException(sprintf('Model class %s could not be found', $type));
        }

        $modelName = __NAMESPACE__ . '\\' . $modelName;
        /** @var AbstractModel $model */
        $model = new $modelName($this->container);

        if (is_array($data) && array_key_exists('id', $data)) {
            $model->instantiate($data);
        } elseif ($data !== null) {
            throw new \InvalidArgumentException('BaseModel requires either an integer or an array as argument.');
        }

        return $model;
    }

    /**
     * Get the model name
     *
     * @param string $name
     *
     * @return bool|string  false if model does not exists
     */
    protected function getModelName($name)
    {
        $fileName = $name . '.php';
        if (file_exists(__DIR__ . '/' . $fileName)) {
            $info = pathinfo($fileName);
            return $info['filename'];
        }
        $fileName = mb_strtolower($fileName);

        $files = glob(__DIR__ . '/*', GLOB_NOSORT);
        foreach ($files as $file) {
            $info = pathinfo($file);
            if (mb_strtolower($info['basename']) === $fileName) {
                return $info['filename'];
            }
        }

        return false;
    }
}
