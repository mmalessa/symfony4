<?php
namespace App\Query;

class DomainQuery
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function ListAll()
    {
        return $this->connection->fetchAll("SELECT * FROM domain");
    }
}