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
     * Saves the model to the repository directly through the property.
     * 
     * @param string $modelName
     * @param Model $model
     * 
     * @return [type]
     */
    public function __set(string $modelName, Model $model): void
    {
        $this->models[$modelName] = $model;
    }

    /**
     * Return a model when accessing directly through a property.
     * 
     * @param string $modelName
     * 
     * @return Model
     */
    public function __get(string $modelName): Model | null
    {
        return $this->models[$modelName] ?? null;
    }
}