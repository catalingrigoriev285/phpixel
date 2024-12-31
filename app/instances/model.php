<?php
require 'app/instances/database.php';

class Model
{
    protected static $instance = null;
    protected $table;
    protected $primaryKey = 'id';
    protected $pdo;
    protected $attributes = [];

    public function __construct()
    {
        $config = require 'app/config.php';
        $this->pdo = Database::getInstance($config)->getConnection();
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->attributes)) {
            return $this->attributes[$name];
        }
        return null;
    }

    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    public function __isset($name)
    {
        return isset($this->attributes[$name]);
    }

    public static function getInstance()
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public static function find($id)
    {
        $instance = static::getInstance();
        $query = $instance->pdo->prepare("SELECT * FROM $instance->table WHERE $instance->primaryKey = :id");
        $query->execute(['id' => $id]);
        return $query->fetch();
    }

    public static function create($data)
    {
        $instance = static::getInstance();
        $columns = implode(',', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        $query = $instance->pdo->prepare("INSERT INTO $instance->table ($columns) VALUES ($placeholders)");
        return $query->execute($data);
    }

    public static function update($data, $id)
    {
        $instance = static::getInstance();
        $columns = '';
        foreach ($data as $key => $value) {
            $columns .= $key . ' = :' . $key . ',';
        }
        $columns = rtrim($columns, ',');

        $data['id'] = $id;

        $query = $instance->pdo->prepare("UPDATE $instance->table SET $columns WHERE $instance->primaryKey = :id");
        return $query->execute($data);
    }

    public static function delete($id)
    {
        $instance = static::getInstance();
        $query = $instance->pdo->prepare("DELETE FROM $instance->table WHERE $instance->primaryKey = :id");
        return $query->execute(['id' => $id]);
    }

    public static function all()
    {
        $instance = static::getInstance();
        $query = $instance->pdo->query("SELECT * FROM $instance->table");
        return $query;
    }
}
?>