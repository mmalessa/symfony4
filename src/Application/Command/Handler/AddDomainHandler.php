<?php
namespace App\Application\Command\Handler;

use App\Application\Command\AddDomain;
use App\Domain\DomainRepository;


class AddDomainHandler
{
    private $domainRepository;

    public function __construct(DomainRepository $domainRepository)
    {
        $this->domainRepository = $domainRepository;
    }

    public function handle(AddDomain $addDomain)
    {
        $this->domainRepository->save(
            $addDomain->getId(),
            $addDomain->getName(),
            $addDomain->getGroupId()
        );
    }
}