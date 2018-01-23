<?php
namespace App\Infrastructure\Query\DBAL;

use App\Application\Query\DomainQuery;

class DbalDomainQuery implements DomainQuery
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function ListAll()
    {
        return $this->connection->fetchAll("
            SELECT d.`id`, d.`name` AS `domainName`, g.`name` AS `groupName` 
            FROM `domain` d LEFT JOIN `group` g ON d.`group_id` = g.`id`");
    }
}