<?php
namespace App\Infrastructure\Repository\Doctrine;

use App\Domain\Repository\DomainRepository;
use App\Domain\Entity\Domain;
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

    public function add($id, $name, $groupId)
    {
        $domain = $this->get($id);
        if ($domain === null) {
            $domain = new Domain();
        }

        $group = null;
        if ($groupId != null) {
            $group = $this->em->getReference('App:Group', $groupId);
        }

        $domain->setId($id);
        $domain->setName($name);
        $domain->setGroup($group);

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