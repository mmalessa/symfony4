<?php
namespace App\Application\Command\Handler;

use App\Application\Command\AddDomain;
use App\Application\Command\ModifyDomains;


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
        $groupId = $modifyDomains->getGroupId();
        foreach ($ids as $id) {

            $addDomain = new AddDomain($id, 'http://www.modified' . rand(100,999) . '.com', $groupId);
            $this->addDomainHandler->handle($addDomain);
        }
    }
}