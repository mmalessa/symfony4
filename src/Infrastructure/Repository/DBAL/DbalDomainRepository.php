<?php
namespace App\Infrastructure\Repository\DBAL;

use App\Domain\Repository\DomainRepository;
use Doctrine\DBAL\Connection;

class DbalDomainRepository implements DomainRepository
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function get($id)
    {
        $stmt = $this->connection->prepare("SELECT d.id, d.name AS domainName, g.name AS groupName   
          FROM domain d
          LEFT JOIN group g ON d.group_id = g.id 
          WHERE id = :id");
        $stmt->bindValue('id', $id);
        return $stmt->fetch();
    }

    public function add($id, $name, $groupId)
    {
        $stmt = $this->connection->prepare("INSERT INTO `domain` (`id`, `name`, `group_id`) 
            VALUES (:Id, :Name, :GroupId) 
            ON DUPLICATE KEY UPDATE `name` = :Name, `group_id` = :GroupId");
        $stmt->bindValue('Id', $id);
        $stmt->bindValue('Name', $name);
        $stmt->bindValue('GroupId', $groupId);
        $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->connection->prepare("DELETE FROM `domain` WHERE id = :id");
        $stmt->bindValue('id', $id);
        $stmt->execute();
    }
}