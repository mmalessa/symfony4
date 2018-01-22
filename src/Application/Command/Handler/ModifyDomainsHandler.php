<?php
namespace App\Application\Command\Handler;

use App\Application\Command\AddDomain;
use App\Application\Command\ModifyDomains;
use Doctrine\ORM\EntityManager;


class ModifyDomainsHandler
{
    private $addDomainHandler;

    public function __construct(AddDomainHandler $addDomainHandler)
    {
        $this->addDomainHandler = $addDomainHandler;
    }

    public function handle(ModifyDomains $modifyDomains)
    {
        $ids = $modifyDomains->getIds();
        foreach ($ids as $id) {
            $addDomain = new AddDomain($id, 'http://www.modified' . rand(100,999) . '.com', rand(10,99));
            $this->addDomainHandler->handle($addDomain);
        }
    }
}