<?php

declare(strict_types=1);

namespace Core\Repository;

use Core\Database\Database;
use Core\Model\Model;
use PDO;

abstract class Repository
{
    protected PDO $db;
    protected array $models = [];

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * This method takes the name of the model and the model itself, then saves it to the repository.
     * 
     * @param Model $model
     * 
     * @return Repository
     */
    public function withModel(Model $model): Repository
    {
        $namespaces = explode('\\', get_class($model));
        $className = strtolower(end($namespaces));

        $this->__set($className, $model);
        
        return $this;
    }

    /**
     * If the model is missing, saves it to the repository.
     * 
     * @param string $modelName
     * @param Model $model
     * 
     * @return [type]
     */
    public function __set(string $modelName, Model $model)
    {
        $this->models[$modelName] = $model;
    }
}