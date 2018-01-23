<?php
namespace App\Infrastructure\Query\DBAL;

use App\Application\Query\GroupQuery;

class DbalGroupQuery implements GroupQuery
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function ListAll()
    {
        return $this->connection->fetchAll("SELECT * FROM `group`");
    }
}