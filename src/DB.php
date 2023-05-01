<?php

namespace CodeCrafter\ControllerStatistics;

use Medoo\Medoo;

class DB
{
    public Medoo $database;
    private array $config;
    public function __construct()
    {
        $this->config['type'] = $_ENV['DB_TYPE'];
        $this->config['host'] = $_ENV['DB_HOST'];
        $this->config['database'] = $_ENV['DB_NAME'];
        $this->config['username'] = $_ENV['DB_USER'];
        $this->config['password'] = $_ENV['DB_PASSWORD'];

        $this->database = new Medoo($this->config);
    }


}