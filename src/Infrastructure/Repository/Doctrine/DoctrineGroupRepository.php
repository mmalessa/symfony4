<?php
namespace App\Infrastructure\Repository\Doctrine;

use App\Domain\Repository\GroupRepository;
use App\Domain\Entity\Group;
use Doctrine\ORM\EntityManager;

class DoctrineGroupRepository implements GroupRepository
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function get($id)
    {
        return $this->em->getRepository("Group")->findOneById($id);
    }

    public function add($id, $name)
    {
        $group = $this->get($id);
        if ($group === null) {
            $group = new Group();
        }

        $group->setId($id);
        $group->setName($name);
        $group->setGroupId($groupId);

        $this->em->persist($group);
    }

    public function delete($id)
    {
        $group = $this->get($id);
        if ($group === null) {
            return;
        }
        $this->em->remove($group);
    }

    public function getRandom()
    {
        $groups = $this->em->getRepository("Group")->findAll();
        if($groups === null) {
            return [];
        }
        shuffle($groups);
        return $groups[0];
    }
}