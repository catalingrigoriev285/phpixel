<?php
    class Database {
        private static $instance;
        private $pdo;

        public function __construct($config){
            $this->pdo = new PDO(
                'mysql:host='.$config['database']['host'].';dbname='.$config['database']['dbname'],
                $config['database']['user'],
                $config['database']['password']
            );

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        public static function getInstance($config){
            if(!isset(self::$instance)){
                self::$instance = new self($config);
            }

            return self::$instance;
        }

        public function getConnection(){
            return $this->pdo;
        }
    }
?>