<?php
namespace App\Application\Command\Handler;

use App\Application\Command\DeleteDomain;
use App\Domain\DomainRepository;

class DeleteDomainHandler
{
    private $domainRepository;

    public function __construct(DomainRepository $domainRepository)
    {
        $this->domainRepository = $domainRepository;
    }

    public function handle(DeleteDomain $deleteDomain)
    {
        $id = $deleteDomain->getId();
        $this->domainRepository->delete($id);
    }
}