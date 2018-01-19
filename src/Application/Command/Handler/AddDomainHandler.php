<?php
namespace App\Application\Command\Handler;

use App\Application\Command\AddDomain;
use Doctrine\DBAL\Connection;
use Ramsey\Uuid\Uuid;

class AddDomainHandler
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function handle(AddDomain $addDomain)
    {
        $payload = $addDomain->payload();
        $domainName = $payload['name'];
        $registerId = $payload['registerId'];
        $id = Uuid::uuid1()->getHex();

        $stmt = $this->connection->prepare("INSERT INTO `domain` (`id`, `name`, `group_id`) 
            VALUES (:Id, :Name, :GroupId) 
            ON DUPLICATE KEY UPDATE `name` = :Name, `group_id` = :GroupId");
        $stmt->bindValue('Id', $id);
        $stmt->bindValue('Name', $domainName);
        $stmt->bindValue('GroupId', $registerId);
        $stmt->execute();

        echo "$domainName  ---  $registerId --- $id";
    }
}