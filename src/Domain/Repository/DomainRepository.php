<?php
namespace App\Domain\Repository;

interface DomainRepository
{
    public function get($id); // get(DomainId $id)
    public function add($id, $name, $groupId); // save(Domain $domain)
    public function delete($id);
}