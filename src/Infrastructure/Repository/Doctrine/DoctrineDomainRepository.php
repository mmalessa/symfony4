<?php
namespace App\Infrastructure\Repository\Doctrine;

use App\Domain\DomainRepository;
use App\Entity\Domain;
use Doctrine\ORM\EntityManager;

class DoctrineDomainRepository implements DomainRepository
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function get($id)
    {
        return $this->em->getRepository("App:Domain")->findOneById($id);
    }

    public function save($id, $name, $groupId)
    {
        $domain = $this->get($id);
        if ($domain === null) {
            $domain = new Domain();
        }

        $domain->setId($id);
        $domain->setName($name);
        $domain->setGroupId($groupId);

        $this->em->persist($domain);
//        $this->em->flush($domain);

    }

    public function delete($id)
    {
        $domain = $this->get($id);
        if ($domain === null) {
            return;
        }
        $this->em->remove($domain);
    }
}