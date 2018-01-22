<?php
namespace App\Domain;

interface DomainRepository
{
    public function get($id); // get(DomainId $id)
    public function save($id, $name, $groupId); // save(Domain $domain)
    public function delete($id);
}