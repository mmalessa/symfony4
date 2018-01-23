<?php
namespace App\Infrastructure\Repository\DBAL;

use App\Domain\Repository\GroupRepository;
use Doctrine\DBAL\Connection;

class DbalGroupRepository implements GroupRepository
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function get($id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM group WHERE id = :id");
        $stmt->bindValue('id', $id);
        return $stmt->fetch();
    }

    public function add($id, $name)
    {
        $stmt = $this->connection->prepare("INSERT INTO `group` (`id`, `name`) 
            VALUES (:Id, :Name) 
            ON DUPLICATE KEY UPDATE `name` = :Name");
        $stmt->bindValue('Id', $id);
        $stmt->bindValue('Name', $name);
        $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->connection->prepare("DELETE FROM `group` WHERE id = :id");
        $stmt->bindValue('id', $id);
        $stmt->execute();
    }

    public function getRandom()
    {
        return $this->connection->fetchAll("SELECT * FROM group ORDER BY RAND LIMIT 1");
    }
}